## Synopsis

This is a portfolio site for **Ely Bascoy**. It contains: 

- A public API to parse request headers (request-header-parser)
    * Returns JSON containing the client's IP Address, language, and operating system.
- A public API to create shortened URL's (short)
    * Responds to a get request with a 'url' parameter containing the url you would like to shorten.
    * Returns JSON containing the original url and the shortened url.
    * When the shortened URL is typed in the browser, the user is redirected to the original long url.

## Code Example

* request-header-parser:
    * url = {SITE_URL}/api/request-header-parser
    * sample return 
    ```json 
            {
                "ipaddress": "127.0.0.1",
                "language": "en-US"
                "software": "Windows 10"
             }
     ```
* short _{SITE_URL} in examples refers to the url to your site_
    * sample creation usage (works without the scheme as well):
    ```
    {SITE_URL}/short/new?url=http://www.google.com
    ```
    * sample creation output:
    ```json
    {
        "original_url": "http://www.google.com",
        "short_url": "http:{SITE_URL}/1"
    }
    ```
    * usage of creation output:
    ```
    http://{SITE_URL}/1 will redirect to http://www.google.com
    ```
