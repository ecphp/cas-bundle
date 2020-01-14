<?php

declare(strict_types=1);

namespace spec\EcPhp\CasBundle;

use EcPhp\CasLib\Configuration\Properties as CasProperties;
use PhpSpec\ObjectBehavior;
use Symfony\Component\HttpClient\MockHttpClient;
use Symfony\Component\HttpClient\Response\MockResponse;
use tests\EcPhp\CasLib\Exception\TestClientException;

class Cas extends ObjectBehavior
{
    public static function getHttpClientMock()
    {
        $callback = static function ($method, $url, $options) {
            $body = '';
            $info = [];

            switch ($url) {
                case 'http://local/cas/serviceValidate?service=service&ticket=ticket':
                case 'http://local/cas/serviceValidate?ticket=ST-ticket&service=http%3A%2F%2Ffrom':
                case 'http://local/cas/serviceValidate?ticket=ST-ticket&service=http%3A%2F%2Flocal%2Fcas%2FserviceValidate%3Fservice%3Dservice':
                case 'http://local/cas/serviceValidate?ticket=PT-ticket&service=http%3A%2F%2Flocal%2Fcas%2FproxyValidate%3Fservice%3Dservice':
                case 'http://local/cas/serviceValidate?ticket=PT-ticket&service=http%3A%2F%2Ffrom':
                $body = <<< 'EOF'
<cas:serviceResponse xmlns:cas="http://www.yale.edu/tp/cas">
 <cas:authenticationSuccess>
  <cas:user>username</cas:user>
 </cas:authenticationSuccess>
</cas:serviceResponse>
EOF;

                break;
                case 'http://local/cas/serviceValidate?service=service&ticket=ticket-failure':
                    $body = <<< 'EOF'
<cas:serviceResponse xmlns:cas="http://www.yale.edu/tp/cas">
 <cas:authenticationFailure>
 </cas:authenticationFailure>
</cas:serviceResponse>
EOF;

                    break;
                case 'http://local/cas/proxyValidate?service=service&ticket=ticket':
                case 'http://local/cas/proxyValidate?ticket=PT-ticket&service=http%3A%2F%2Ffrom':
                case 'http://local/cas/proxyValidate?ticket=ST-ticket&service=http%3A%2F%2Ffrom':
                case 'http://local/cas/proxyValidate?service=http%3A%2F%2Flocal%2Fcas%2FproxyValidate%3Fservice%3Dservice&ticket=ticket':
                case 'http://local/cas/proxyValidate?service=http%3A%2F%2Flocal%2Fcas%2FproxyValidate%3Fservice%3Dservice%26renew%3Dtrue&ticket=ticket&renew=true':
                case 'http://local/cas/proxyValidate?service=http%3A%2F%2Flocal%2Fcas%2FserviceValidate%3Fservice%3Dservice&ticket=ticket':
                case 'http://local/cas/proxyValidate?service=http%3A%2F%2Flocal%2Fcas%2FserviceValidate%3Fservice%3Dservice%26renew%3Dtrue&ticket=ticket&renew=true':
                    $body = <<< 'EOF'
<cas:serviceResponse xmlns:cas="http://www.yale.edu/tp/cas">
 <cas:authenticationSuccess>
  <cas:user>username</cas:user>
  <cas:proxies>
    <cas:proxy>http://app/proxyCallback.php</cas:proxy>
  </cas:proxies>
 </cas:authenticationSuccess>
</cas:serviceResponse>
EOF;

                    break;
                case 'http://local/cas/serviceValidate?ticket=ST-ticket-pgt&service=http%3A%2F%2Ffrom':
                    $body = <<< 'EOF'
<cas:serviceResponse xmlns:cas="http://www.yale.edu/tp/cas">
 <cas:authenticationSuccess>
  <cas:user>username</cas:user>
  <cas:proxyGrantingTicket>pgtIou</cas:proxyGrantingTicket>
 </cas:authenticationSuccess>
</cas:serviceResponse>
EOF;

                    break;
                case 'http://local/cas/serviceValidate?ticket=ST-ticket-pgt-pgtiou-not-found&service=http%3A%2F%2Ffrom':
                    $body = <<< 'EOF'
<cas:serviceResponse xmlns:cas="http://www.yale.edu/tp/cas">
 <cas:authenticationSuccess>
  <cas:user>username</cas:user>
  <cas:proxyGrantingTicket>unknownPgtIou</cas:proxyGrantingTicket>
 </cas:authenticationSuccess>
</cas:serviceResponse>
EOF;

                    break;
                case 'http://local/cas/proxyValidate?ticket=ST-ticket-pgt-pgtiou-pgtid-null&service=http%3A%2F%2Ffrom':
                    $body = <<< 'EOF'
<cas:serviceResponse xmlns:cas="http://www.yale.edu/tp/cas">
 <cas:authenticationSuccess>
  <cas:user>username</cas:user>
  <cas:proxyGrantingTicket>pgtIouWithPgtIdNull</cas:proxyGrantingTicket>
 </cas:authenticationSuccess>
</cas:serviceResponse>
EOF;

                    break;
                case 'http://local/cas/proxyValidate?service=service&ticket=ST-ticket-pgt':
                case 'http://local/cas/proxyValidate?ticket=ST-ticket-pgt&service=http%3A%2F%2Ffrom':
                case 'http://local/cas/proxyValidate?service=http%3A%2F%2Flocal%2Fcas%2FproxyValidate%3Fservice%3Dhttp%253A%252F%252Ffrom&ticket=PT-ticket-pgt':
                    $body = <<< 'EOF'
<cas:serviceResponse xmlns:cas="http://www.yale.edu/tp/cas">
 <cas:authenticationSuccess>
  <cas:user>username</cas:user>
  <cas:proxyGrantingTicket>pgtIou</cas:proxyGrantingTicket>
  <cas:proxies>
    <cas:proxy>http://app/proxyCallback.php</cas:proxy>
  </cas:proxies>
 </cas:authenticationSuccess>
</cas:serviceResponse>
EOF;

                    break;
                case 'http://local/cas/serviceValidate?service=http%3A%2F%2Flocal%2Fcas%2FserviceValidate%3Fservice%3Dservice%26format%3DJSON&ticket=ticket&format=JSON':
                    $body = <<< 'EOF'
{
    "serviceResponse": {
        "authenticationSuccess": {
            "user": "username"
        }
    }
}
EOF;

                    break;
                case 'http://local/cas/proxyValidate?service=http%3A%2F%2Ffrom&ticket=PT-ticket':
                    $body = <<< 'EOF'
<cas:serviceResponse xmlns:cas="http://www.yale.edu/tp/cas">
 <cas:authenticationSuccess>
  <cas:user>username</cas:user>
  <cas:proxyGrantingTicket>pgtIou</cas:proxyGrantingTicket>
  <cas:proxies>
    <cas:proxy>http://app/proxyCallback.php</cas:proxy>
  </cas:proxies>
 </cas:authenticationSuccess>
</cas:serviceResponse>
EOF;

                    break;
                case 'http://local/cas/proxy?targetService=targetService&pgt=pgt':
                    $body = <<< 'EOF'
<?xml version="1.0" encoding="utf-8"?>
<cas:serviceResponse xmlns:cas="https://ecas.ec.europa.eu/cas/schemas"
                     server="ECAS MOCKUP version 4.6.0.20924 - 09/02/2016 - 14:37"
                     date="2019-10-18T12:17:53.069+02:00" version="4.5">
	<cas:proxySuccess>
		<cas:proxyTicket>PT-214-A3OoEPNr4Q9kNNuYzmfN8azU31aDUsuW8nk380k7wDExT5PFJpxR1TrNI3q3VGzyDdi0DpZ1LKb8IhPKZKQvavW-8hnfexYjmLCx7qWNsLib1W-DCzzoLVTosAUFzP3XDn5dNzoNtxIXV9KSztF9fYhwHvU0</cas:proxyTicket>
	</cas:proxySuccess>
</cas:serviceResponse>
EOF;

                    break;
                case 'http://local/cas/proxy?targetService=targetService&pgt=pgt-error-in-getCredentials':
                    $body = <<< 'EOF'
<?xml version="1.0" encoding="utf-8"?>
<cas:serviceResponse xmlns:cas="https://ecas.ec.europa.eu/cas/schemas"
                     server="ECAS MOCKUP version 4.6.0.20924 - 09/02/2016 - 14:37"
                     date="2019-10-18T12:17:53.069+02:00" version="4.5">
	<cas:proxyFailure>
	TODO: Find something to put here.
    </cas:proxyFailure>
</cas:serviceResponse>
EOF;

                    break;
                case 'http://local/cas/serviceValidate?service=http%3A%2F%2Ffrom&ticket=BAD-http-query':
                case 'http://local/cas/proxyValidate?service=http%3A%2F%2Ffrom&ticket=BAD-http-query':
                case 'http://local/cas/proxyValidate?service=http%3A%2F%2Flocal%2Fcas%2FproxyValidate%3Fservice%3Dservice%26error%3DTestClientException&ticket=ticket&error=TestClientException':
                case 'http://local/cas/proxy?targetService=targetService&pgt=pgt&error=TestClientException':
                    throw new TestClientException();

                    break;
            }

            return new MockResponse($body, $info);
        };

        return new MockHttpClient($callback);
    }

    /**
     * @return \EcPhp\CasLib\Configuration\Properties
     */
    public static function getTestProperties(): CasProperties
    {
        return new CasProperties([
            'base_url' => 'http://local/cas',
            'protocol' => [
                'login' => [
                    'path' => '/login',
                    'allowed_parameters' => [
                        'service',
                        'custom',
                        'renew',
                        'gateway',
                    ],
                ],
                'logout' => [
                    'path' => '/logout',
                    'allowed_parameters' => [
                        'service',
                        'custom',
                    ],
                ],
                'serviceValidate' => [
                    'path' => '/serviceValidate',
                    'allowed_parameters' => [
                        'ticket',
                        'service',
                        'custom',
                    ],
                    'default_parameters' => [
                        'format' => 'XML',
                    ],
                ],
                'proxyValidate' => [
                    'path' => '/proxyValidate',
                    'allowed_parameters' => [
                        'ticket',
                        'service',
                        'custom',
                    ],
                    'default_parameters' => [
                        'format' => 'XML',
                    ],
                ],
                'proxy' => [
                    'path' => '/proxy',
                    'allowed_parameters' => [
                        'targetService',
                        'pgt',
                    ],
                ],
            ],
        ]);
    }

    /**
     * @return \EcPhp\CasLib\Configuration\Properties
     */
    public static function getTestPropertiesWithPgtUrl(): CasProperties
    {
        $properties = self::getTestProperties()->all();

        $properties['protocol']['serviceValidate']['default_parameters']['pgtUrl'] = 'https://from/proxyCallback.php';

        return new CasProperties($properties);
    }
}
