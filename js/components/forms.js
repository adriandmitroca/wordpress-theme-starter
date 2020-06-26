export default class {
  constructor() {
    this.$forms = $(".wpcf7")
  }

  init() {
    $(() => {
      this.$forms.on("submit", event => {
        const button = $(event.target).find("[type=submit]")
        button.attr("disabled", true)
        button.addClass("loader")
      })

      this.$forms.on("wpcf7submit", event => {
        const button = $(event.target).find("[type=submit]")
        button.attr("disabled", false)
        button.removeClass("loader")
      })

      this.$forms.find("select").on("change", event => {
        const { value } = event.target.options[
          event.target.options.selectedIndex
        ]
        $(event.target).toggleClass("filled", value.length)
      })
    })
  }
}
