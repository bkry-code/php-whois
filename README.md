#PHP Whois API
PHP library requesting (via socket port 43) and parsing real WHOIS service responses.

##Requirements
PHP >= 5.4

Modules:
- intl

##Usage

Create default instance for top-level domains __.com .net .ru .рф__
```
$whois = \iodev\whois\Whois::create();
```

If you want add special whois server:
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

Now in __$info__ you have a __\iodev\whois\WhoisInfo__ object with important data fields:
- domainName — Real domain name (punycode).
- domainNameUnicode — Domain name in unicode (decoded punycode).
- nameServers — List of name servers.
- creationDate — Unixtime creation date.
- expirationDate — Unixtime expiration date.
- states — Status list in upper-case.
- owner — Owner (company) name.
- registrar — Registrar name.
- response — __\iodev\whois\WhoisResponse__ object containing original whois response text and parsed grouped key-value pairs.


See __example.php__ for more details
