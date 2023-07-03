<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class AccountController extends Controller
{
    public function getAll($accessToken = null) {
        if (!$accessToken) {
            $authController = new AuthController();
            $accessToken = $authController->getAccessToken();
        }

        $response = Http::withHeader('Authorization', 'Zoho-oauthtoken ' . $accessToken)
            ->get('https://www.zohoapis.eu/crm/v3/Accounts?fields=Account_Name,Phone,Website');
        $accounts = json_decode($response, true);

        return response([
            'accounts' => $accounts
        ]);
    }

    public function create(Request $request) {
        $account = $request->validate([

        ]);

        $authController = new AuthController();
        $accessToken = $authController->getAccessToken();

        $response = Http::withHeader('Authorization', 'Zoho-oauthtoken ' . $accessToken)
            ->withBody(
                (string)$account, 'application/json'
            )->post('https://www.zohoapis.eu/crm/v3/Accounts');
        $accounts = json_decode($response, true);

        return response([
            'account' => $accounts
        ]);
    }

    public function delete($id) {
        $accountId = (int)$id;

        $authController = new AuthController();
        $accessToken = $authController->getAccessToken();

        $response = Http::withHeader('Authorization', 'Zoho-oauthtoken ' . $accessToken)
            ->delete('https://www.zohoapis.eu/crm/v3/Accounts/' . $accountId);

        return response([
            'success' => true
        ]);
    }

    public function update(Request $request, $id) {
        $account = $request->validate([

        ]);

        $authController = new AuthController();
        $accessToken = $authController->getAccessToken();

        $response = Http::withHeader('Authorization', 'Zoho-oauthtoken ' . $accessToken)
            ->withBody(
                (string)$account, 'application/json'
            )->patch('https://www.zohoapis.eu/crm/v3/Accounts/' . $id);

        return response([
            'success' => true
        ]);
    }
}
