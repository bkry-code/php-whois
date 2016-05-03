#PHP Whois API

PHP library requesting (via socket port 43) and parsing real WHOIS service responses.


##Requirements
PHP >= 5.4

Modules:
- intl


##Usage

Create default instance for top-level domains: __.com .net .ru .рф__

```
$whois = \iodev\whois\Whois::create();

```
If you want add special whois server

```
$edu = new \iodev\whois\WhoisServer();
$edu->isCentralized = false;
$edu->topLevelDomain = ".edu";
$edu->host = "whois.crsnic.net";
$edu->infoParser = new ComInfoParser();

// Or via static factory method
$edu = \iodev\whois\WhoisServer::createDistributed(".edu", "whois.crsnic.net", new ComInfoParser());

// Attaching
$whois->addServer($edu);

```

Loading domain info:
```
/* @var $info \iodev\whois\WhoisInfo */
$info = $whois->loadInfo("google.com");

echo $info->domainName . " expiring at: " . date("d.m.Y H:i:s", $info->expirationDate);

var_dump($info);

```
It will return __null__ if domain info not loaded or domain not found or not supported by current whois servers.

Or you can get original whois text response:
```
$info = $whois->loadInfo("google.com");
$response = $info->response;

echo "WHOIS response for '{$response->requestedDomain}':\n{$response->content}";

```

Now you have __\iodev\whois\WhoisInfo__ object with important data fields:
- __domainName__  Real (punycode) domain name.
- __domainNameUnicode__  Domain name coverted to unicode.
- __nameServers__  List of name servers.
- __creationDate__  Unixtime creation date.
- __expirationDate__  Unixtime expiration date.
- __states__  Status list in upper-case.
- __owner__  Owner (company) name.
- __registrar__  Registrar name.
- __response__  \iodev\whois\WhoisResponse object contains original whois response data: raw text and parsed grouped key-value pairs.


See __example.php__ for more details
