<?php

namespace App\Controller;

use Psr\Http\Client\ClientExceptionInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpClient\HttpClient;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Contracts\HttpClient\Exception\RedirectionExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\ServerExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\TransportExceptionInterface;
use Symfony\Contracts\HttpClient\HttpClientInterface;

class WeatherController extends AbstractController
{
    #[Route('/weather', name: 'app_weather')]
    public function meteo(HttpClientInterface $httpClientInterface, Request $request): Response
    {
        $city = $request->query->get('city');

        if ($city) {
            $apiKey = 'your key';
            $client = HttpClient::create();
            $url = sprintf('weather url');


            try {
                $response = $client->request('GET', $url, [
                    'query' => [
                        'token' => $apiKey,
                        'insee' => $city, // Ajoutez ici le code INSEE si nécessaire
                    ]
                ]);

                if ($response->getStatusCode() === 200) {
                    $weatherData = $response->toArray();
                    return $this->render('weather/index.html.twig', [
                        'weatherData' => $weatherData,
                    ]);
                } else {
                    // Gérez les autres codes
                    $this->addFlash('error', 'Erreur: ' . $response->getStatusCode());
                }
            } catch (ClientExceptionInterface | RedirectionExceptionInterface | ServerExceptionInterface | TransportExceptionInterface $e) {
                // Gérez les exceptions
                $this->addFlash('error', 'Une erreur s\'est produite : ' . $e->getMessage());
            }
        }

        return $this->render('weather/index.html.twig', [
            'city' => 'WeatherController',
        ]);
    }
}
