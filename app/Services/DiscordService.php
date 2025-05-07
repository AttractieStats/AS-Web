<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class DiscordService
{
    public function sendMessage($message)
    {
        $webhookUrl = env('DISCORD_WEBHOOK_URL');  // Haal de URL uit de .env

        $data = [
            'content' => $message,  // Het bericht dat je wilt sturen
            'username' => 'AttractieStats Bot',  // De naam die je wilt dat het bericht heeft
        ];

        // Verstuur een POST-verzoek naar de Discord Webhook URL
        Http::post($webhookUrl, $data);
    }
}
