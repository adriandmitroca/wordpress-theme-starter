import "bootstrap/js/dist/util"
import "bootstrap/js/dist/collapse"
import Forms from "./components/forms"

class App {
  static init() {
    new Forms().init()
  }
}

App.init()
