<?php

namespace App\Http\Controllers;

use App\Model\Army;
use App\Service\BattleManager;
use App\Service\UnitGenerator;
use App\Validation\ArmyValidator;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Validator;

class BattleController extends Controller
{
    /**
     * Showing battle results.
     *
     * @param  Request  $request
     * @param  UnitGenerator  $unitGenerator
     * @param  ArmyValidator  $validator
     * @return View
     */
    public function index(Request $request, UnitGenerator $unitGenerator, ArmyValidator $validator): View
    {
        $validator->make($request);

        if ($validator->fails()) {
            return view('battle.index')->withErrors($validator->errors());
        }

        list('army1' => $numberOfUnitsForArmy1, 'army2' => $numberOfUnitsForArmy2) = $validator->getValidatedFields();

        $army1 = new Army('Army1', $unitGenerator->generateUnits($numberOfUnitsForArmy1));
        $army2 = new Army('Army2', $unitGenerator->generateUnits($numberOfUnitsForArmy2));

        $battleResult = (new BattleManager($army1, $army2))->start();

        return view('battle.index', compact('battleResult'));
    }
}
