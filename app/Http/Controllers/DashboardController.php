<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index() {
        $authController = new AuthController();
        $accessToken = $authController->getAccessToken();

        $accountController = new AccountController();
        $dealController = new DealController();

        $accounts = $accountController->getAll($accessToken);
        $deals = $dealController->getAll($accessToken);

        return response([
            'accounts' => $accounts,
            'deals' => $deals
        ]);
    }
}
