# select-patrol-parking-mgmt
Simple app to register for a guest parking pass at https://www.selectpatrol.com automatically. [Laravel Dusk](https://laravel.com/docs/5.8/dusk) is used to navigate the site and submit a request.

## Ask Siri
You can ask Siri to request a parking pass.

Use the [Shotcuts App](https://apps.apple.com/us/app/shortcuts/id915249334) to send a Github API request that will trigger a Github Actions Workflow. The Workflow will then call a [Laravel Dusk](https://laravel.com/docs/5.8/dusk) test case to submit the request.

See [Request Guest Pass Workflow](.github/workflows/request-guest-pass.yml)

Sample Github API Request. [See docs for more details](https://developer.github.com/v3/repos/#create-a-repository-dispatch-event).

````
curl --location --request POST 'https://api.github.com/repos/icheko/select-patrol-parking-mgmt/dispatches' \
--header 'Authorization: Basic YourGithubUsernameAndPersonalAccessTokenInBase64' \
--header 'Content-Type: application/json' \
--data-raw '{
  "event_type": "parking-pass-register",
  "client_payload": {
    "person": "dena"
  }
}'
````
