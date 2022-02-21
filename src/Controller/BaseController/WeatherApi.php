<?php

namespace App\Controller\BaseController;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Contracts\HttpClient\HttpClientInterface;
use OpenCage\Geocoder\Geocoder;

class WeatherApi extends AbstractController
{
    private $client;

    public function __construct(HttpClientInterface $client)
    {
        $this->client = $client;
    }
    # 	755739139912620583039x33881

    #[Route('/get/weather/about/city')]
    public function FetchWeather(Request $request)
    {
        $city = $_POST['city'];
        $geocoder = new Geocoder('dcf0231397344defb6ad5366448f6272');
        $result = $geocoder->geocode($city);
        $lat = $result['results'][0]['annotations']['DMS']['lat'];
        $lng = $result['results'][0]['annotations']['DMS']['lng'];
        $res_lat = explode("'",$lat,-2);
        $res_lat = str_replace(' ','',$res_lat[1]);
        $res_lng = explode("'",$lng,-2);
        $res_lng = str_replace(' ','',$res_lng[1]);
        $response = $this->client->request(
            'GET',
            'https://api.openweathermap.org/data/2.5/onecall?lat='.$res_lat.'&lon='.$res_lng.'&exclude=hourly&appid=2a38ca202ac875341eae2b0013e800b0&units=metric'
        );

        $statusCode = $response->getStatusCode();
        // $statusCode = 200
        $contentType = $response->getHeaders()['content-type'][0];
        // $contentType = 'application/json'
        $content = $response->getContent();
        // $content = '{"id":521583, "name":"symfony-docs", ...}'
        $content = $response->toArray();
        // $content = ['id' => 521583, 'name' => 'symfony-docs', ...]
        return new JsonResponse(['weather'=>$content,'cityName'=>$result['results'][0]['components']['city']]);
    }
}