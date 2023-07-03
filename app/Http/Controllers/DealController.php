<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class DealController extends Controller
{
    public function getAll($accessToken = null) {
        if (!$accessToken) {
            $authController = new AuthController();
            $accessToken = $authController->getAccessToken();
        }

        $response = Http::withHeader('Authorization', 'Zoho-oauthtoken ' . $accessToken)
            ->get('https://www.zohoapis.eu/crm/v3/Deals?fields=Deal_Name,Stage,Account_Name');
        $deals = json_decode($response, true);

        return response([
            'deals' => $deals
        ]);
    }

    public function create(Request $request) {
        $deal = $request;
//            ->validate([
//            'dealName' => 'required|string',
//            'dealStage' => 'required|string',
//            'account' => 'string'
//        ]);

        $authController = new AuthController();
        $accessToken = $authController->getAccessToken();

        $response = Http::withHeader('Authorization', 'Zoho-oauthtoken ' . $accessToken)
            ->withBody(
                (string)$deal, 'application/json'
            )->post('https://www.zohoapis.eu/crm/v3/Deals');
        $deals = json_decode($response, true);

        return response([
            'deals' => $deals
        ]);
    }

    public function delete($id) {
        $dealId = (int)$id;

        $authController = new AuthController();
        $accessToken = $authController->getAccessToken();

        Http::withHeader('Authorization', 'Zoho-oauthtoken ' . $accessToken)
            ->delete('https://www.zohoapis.eu/crm/v3/Deals/' . $dealId);

        return response([
            'success' => $id
        ]);
    }

    public function update(Request $request, $id) {
        $deal = $request->validate([

        ]);

        $authController = new AuthController();
        $accessToken = $authController->getAccessToken();

        $response = Http::withHeader('Authorization', 'Zoho-oauthtoken ' . $accessToken)
            ->withBody(
                (string)$deal, 'application/json'
            )->patch('https://www.zohoapis.eu/crm/v3/Deals/' . $id);
        $deals = json_decode($response, true);

        return response([
            'success' => true
        ]);
    }
}
