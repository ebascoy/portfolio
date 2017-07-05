## Synopsis

This is a portfolio site for **Ely Bascoy**. It contains: 

- A public API to parse request headers (request-header-parser)
    * Returns JSON containing the client's IP Address, language, and operating system.
- A public API to create shortened URL's (short)
    * Responds to a get request with a 'url' parameter containing the url you would like to shorten.
    * Returns JSON containing the original url and the shortened url.
    * When the shortened URL is typed in the browser, the user is redirected to the original long url.
- A public API image search abstraction layer (image)
    * Responds to a get request with a 'term' parameter containing the search term for the image search.
    An optional 'offset' parameter can be passed for pagination (each page returns 10 results, 
    so offset=10 would return the second page, etc.)
    * Returns JSON containing the image url, caption, thumbnail, and context.
    * Requests to /api/image/recent return JSON containing the 10 most recent search terms 
    and the time of each search.
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
* image:
    * sample search without offset
    ```
    {SITE_URL}/api/image/search?term=hoola
    ```
    * sample search with offset
    ```
    {SITE_URL}/api/image/search?term=hoola&offset=10
    ```
    * sample return
    ```json
    [
        {
            "url": "https://i.ytimg.com/vi/fattN0AENZA/maxresdefault.jpg",
            "snippet": "How to Use <b>Hoola</b> Bronzer 🌴 - YouTube",
            "thumbnail": "https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQRWOWMz7R3CsQxtUQ7l7IvjzJ-Jbml7VwLKJzRJ2lcAGl2l_b8Eaw7daae",
            "context": "https://www.youtube.com/watch?v=fattN0AENZA"
        },
        {
        "url": "http://images.ulta.com/is/image/Ulta/2160264",
        "snippet": "<b>Hoola</b> Matte Bronzer | Ulta Beauty",
        "thumbnail": "https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRisvxjxaj644_LRSyP1MEvGy6JM4lyr8dQy6NaQwW9iko9AYvZECXx40e9",
        "context": "http://www.ulta.com/hoola-matte-bronzer?productId=xlsImpprod820346"
        }
        ...
    ]
    ```
    * request for recent searches
    ```
    {SITE_URL}/api/image/recent
    ```
    * sample recent searches output
    ```JSON
    [
        {
            "term": "hoola",
            "when": {
                "date": "2017-07-05 19:22:56.000000",
                "timezone_type": 3,
                "timezone": "UTC"
            }
        },
        {
            "term": "hoola",
            "when": {
                "date": "2017-07-05 19:22:41.000000",
                "timezone_type": 3,
                "timezone": "UTC"
            }
        }
        ...
    ]
    ```