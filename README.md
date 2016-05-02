#PHP Whois API

Realtime PHP library for socket requests and parsing responses from WHOIS servers.


##Requirements

PHP >= 5.4
PECL __intl__ module


##Usage

Create default instance for top-level domains: .com .net .ru .рф

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

Loading domain info

```
/* @var $info \iodev\whois\WhoisInfo */
$info = $whois->loadInfo("google.com");

echo $info->domainName . " expiring at: " . date("d.m.Y H:i:s", $info->expirationDate);

var_dump($info);

```
_It will return __null__ if domain info not loaded or domain not found or not supported by current whois servers._

Now you have whois info object with important data fields:
- __domainName__  _string_  Real (punycode) domain name.
- __domainNameUnicode__  _string_  Domain name coverted to unicode.
- __nameServers__  _string[]_  List of name servers.
- __creationDate__  _int_  Unixtime creation date.
- __expirationDate__  _int_  Unixtime expiration date.
- __states__  _string[]_  Status list in upper-case.
- __owner__  _string_  Owner (company) name.
- __registrar__  _string_  Registrar name.
- response  _\iodev\whois\WhoisResponse_ object contains original whois response data: raw text and parsed grouped key-value pairs.


See _example.php_ for more details