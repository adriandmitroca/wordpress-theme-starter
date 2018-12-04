<?php

class ModulePreview
{
    const INDEX = 'sections';

    protected $actionKey = 'module-preview';

    public function __construct()
    {
        if ( ! function_exists('get_field')) {
            return;
        }

        $this->setupEndpoints();
        $this->setupButton();
    }

    public function setupEndpoints()
    {
        add_action('wp_ajax_' . $this->actionKey, [$this, 'render']);
    }

    public function setupButton()
    {
        add_action('admin_bar_menu', function ($bar) {
            $bar->add_menu(
                [
                    'id' => 'acf-modules',
                    'title' => __('Preview Modules'),
                    'href' => '/wp-admin/admin-ajax.php?action=' . $this->actionKey,
                    'meta' => [
                        'target' => '_blank',
                        'title' => 'Preview all available modules based on existing pages that were already configured.',
                    ],
                ]);
        }, 150);
    }

    public function render()
    {
        $group = $this->guessFieldGroup();
        $modules = $this->getAvailableModules($group);
        wp_head();

        foreach ($modules as $module) {
            $this->display($module);
        }

        wp_footer();
        wp_die();
    }

    protected function guessFieldGroup()
    {
        $groups = get_posts([
            'post_type' => 'acf-field-group',
        ]);

        foreach ($groups as $group) {
            $locations = unserialize($group->post_content)['location'];
            $locations = array_filter($locations, function ($item) {
                if ($item[0]['param'] === 'page_template' && $item[0]['value'] === 'default') {
                    return true;
                }

                if ($item[0]['param'] === 'post_type' && $item[0]['value'] === 'template') {
                    return true;
                }

                return false;
            });

            if (count($locations) === 2) {
                return $group;
            }
        }

        return false;
    }

    protected function getAvailableModules(WP_Post $group)
    {
        $fields = get_children([
            'post_parent' => $group->ID,
            'post_type' => 'acf-field',
            'numberposts' => -1,
            'post_status' => 'any',
        ]);
        $modules = [];

        foreach ($fields as $field) {
            $content = unserialize($field->post_content);

            if ($content['type'] === 'flexible_content') {
                $modules = $content['layouts'];
                break;
            }
        }

        $modules = array_filter($modules, function ($item) {
            return $item['name'] !== 'predefined_template';
        });

        return $modules;
    }

    protected function display(array $target)
    {
        $data = $this->findExample($target['name']);
        ?>

      <h2 class="section-title text-center py-4 my-0 bg-info text-white">Examples: <?= $target['label'] ?></h2>

        <?php if ( ! count($data)): ?>
      <div class="container">
        <div class="mt-5 text-center alert alert-danger">
          Examples not found.
        </div>
      </div>
    <?php endif ?>

        <?php foreach ($data as $_item): ?>
        <?php if ($module = $_item['module']): ?>
            <?php
            global $post;
            $post = $_item['page'];
            ?>
        <div class="border-bottom">
            <?php include get_template_directory() . "/acf-modules/{$target['name']}.php"; ?>
          <p class="text-center text-black-50 mt-1 mb-4">
            (source: <a target="_blank"
                        href="<?= get_permalink($_item['page']) ?>"><?= $_item['page']->post_title ?></a>)
          </p>
        </div>
        <?php endif ?>
    <?php endforeach;
    }

    public static function findExample($module_name, $limit = 3)
    {
        $pages = (new WP_Query([
            'post_type' => ['page', 'template'],
            'meta_query' => [
                [
                    'key' => self::INDEX,
                    'value' => $module_name,
                    'compare' => 'LIKE',
                ],
            ],
        ]))->posts;
        $content = [];

        foreach ($pages as $page) {
            $data = array_filter(get_field(self::INDEX, $page), function ($item) use ($module_name) {
                return $item['acf_fc_layout'] === $module_name;
            });

            if ($data) {
                $content[] = [
                    'page' => $page,
                    'module' => current($data),
                ];
            }
        }

        if ($limit === 1) {
            return $content[0];
        }

        return array_slice($content, 0, $limit);
    }
}

(new ModulePreview());
