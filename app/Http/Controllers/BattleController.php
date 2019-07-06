<?php

namespace App\Http\Controllers;

use App\Model\Army;
use App\Service\BattleManager;
use App\Service\UnitGenerator;
use Illuminate\Http\Request;
use Illuminate\View\View;

class BattleController extends Controller
{
    public function index(Request $request, UnitGenerator $unitGenerator): View
    {
        $numberOfUnitsForArmy1 = $request->query('army1');
        $numberOfUnitsForArmy2 = $request->query('army2');

        $army1 = new Army('Army1', $unitGenerator->generateUnits($numberOfUnitsForArmy1));
        $army2 = new Army('Army2', $unitGenerator->generateUnits($numberOfUnitsForArmy2));

        $battleResult = (new BattleManager($army1, $army2))->start();

        return view('battle.index', compact('battleResult'));
    }
}
