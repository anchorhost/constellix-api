# Constellix API WordPress Wrapper

Built to be used within WordPress for accessing Constellix's API to manage DNS records.

## Table of Contents

1. [Implementation](#implementation)
2. [Changelog](#changelog)
3. [License](#license)

## Implementation

Start by adding the Constellix's API keys from [manage.constellix.com/user](https://manage.constellix.com/user) to wp-config.php.

```
define( 'CONSTELLIX_API_KEY', "XXXXXXXXXXXXXXXXXXXXXXXXXXX");
define( 'CONSTELLIX_SECRET_KEY', "XXXXXXXXXXXXXXXXXXXXXXXXXXX");
```

Next include in WordPress theme or plugin: `include "constellix-api/constellix-api.php";`.

### Fetch all domains

```
$response = constellix_api_get("domains");

foreach($response as $domain) {
  $domain_id = $domain->id;
  $domain_name = $domain->name;
  $domain_nameservers = $domain->nameservers;
}
```

### Fetching records

```
$response = constellix_api_get("domains/$domain_id/records/a");
$response = constellix_api_get("domains/$domain_id/records/mx");
$response = constellix_api_get("domains/$domain_id/records/cname");
$response = constellix_api_get("domains/$domain_id/records/httprr"); # HTTP Redirection Record

foreach($response as $records) {
  $record_id = $records->id;
  $record_name = $records->name;
  $record_zone = $records->zone;  // Used for CNAME records
  $record_values = $records->value;

  foreach($record_values as $record) {
    $record_value = $record->value;
    $record_level = $record->level;  // Used by MX records
  }

}
```

### Creates new domain zone

```
$post = array(
  "names" => array(
    "newanchordomain1.com",
    "newanchordomain2.com"
    )
  );

$response = constellix_api_post("domains", $post);
foreach($response as $domain) {
  // Capture new domain IDs from $response
  $domain_id = $domain->id;
  $domain_name = $domain->name;
}
```

### Creates new CNAME record

```
$domain_id = "1234";

$post = array(
  "name" => "sample",
  "host" => "new.anchor.host",
  "ttl" => 1800,
  );

$response = constellix_api_post("domains/$domain_id/records/cname", $post);
```

### Creates new A record

```
$domain_id = "1234";

$post = array(
  "recordOption" => "roundRobin",
  "name" => "sample",
  "ttl" => 1800,
  "roundRobin" => array(
    array(
      "value" => "104.197.69.102",
      "disableFlag" => false,
    ),
   ),
);

$response = constellix_api_post("domains/$domain_id/records/a", $post);
```

### Deletes Specific CNAME record
```
$domain_id = "1234";
$record_id = "1234";
$response = constellix_api_delete("domains/$domain_id/records/cname/$record_id");
```

**[Back to top](#table-of-contents)**

## Changelog

## [0.1.0] - 2017-12-11
### Added
- Initial release of constellix-api.php. Includes PHP wrappers for sending GET, POST and DELETE requests to [Constellix's API](http://help.constellix.com/rest-api/). Based on their [official Perl code sample](https://support.constellix.com/index.php?/Knowledgebase/Article/View/3/4/download-constellixapipl).

**[Back to top](#table-of-contents)**

## License

#### (The MIT License)

Copyright (c) 2017 Anchor Hosting

Permission is hereby granted, free of charge, to any person obtaining a copy of this software and associated documentation files (the "Software"), to deal in the Software without restriction, including without limitation the rights to use, copy, modify, merge, publish, distribute, sublicense, and/or sell copies of the Software, and to permit persons to whom the Software is furnished to do so, subject to the following conditions:

The above copyright notice and this permission notice shall be included in all copies or substantial portions of the Software.

THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY, FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM, OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE SOFTWARE.

**[Back to top](#table-of-contents)**
