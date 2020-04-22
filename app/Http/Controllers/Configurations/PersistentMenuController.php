<?php

namespace App\Http\Controllers\Configurations;

use App\Http\Controllers\Controller;
use App\Services\Messengers\Configurations\PersistentMenu;
use Illuminate\Http\Request;

class PersistentMenuController extends Controller
{

    private $persistent_menu;

    public function __construct(PersistentMenu $persistent_menu)
    {
        $this->persistent_menu = $persistent_menu;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update($psid = null)
    {
        if ($psid !== null) {
            $psid = "3759041764138390";
            return $this->persistent_menu->editUser($psid);
        }
        return $this->persistent_menu->edit();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($psid = null)
    {
        if ($psid === null) {
            return;
        }
        $psid = "3759041764138390";
        return $this->persistent_menu->deleteUser($psid);
    }
}
