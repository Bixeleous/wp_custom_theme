const axios = require("axios")

class Custom_Post_Button {
  constructor() {
    this.buttons = document.querySelectorAll(".custom_post_button")
    this.events()
  }

  events() {
    this.buttons.forEach(button => {
      button.addEventListener("click", () => this.show_info(button))
    })
  }

  show_info(button) {
    let post_id = button.id // the button has the id of the clicked post
    let BASE_URL = "http://localhost/wp-app/wp-json/wp/v2/custom_post/" //the url of the site

    let axios_url = BASE_URL + post_id + "?_embed" //the url you are sending the request to

    //let axios_url = "http://localhost/wp-app/wp-json/custom-api/v1/custom_post/"

    axios
      .get(axios_url)
      .then(function (response) {
        // console.log(response)
        let data = response.data //getting the response data
        // console.log(response.data)

        console.log("Author id is " + data.author)
        console.log("Author name is " + data._embedded.author[0].name)
        console.log("Post Id is " + data.id)
        if (data.custom_field["test"] == undefined) {
          data.custom_field["test"] = "empty"
        }
        console.log("Post custom field test is " + data.custom_field["test"]) // getting custom field data
      })
      .catch(function () {
        console.log("There was an error")
      })
  }
}

export default Custom_Post_Button
