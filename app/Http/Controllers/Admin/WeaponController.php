<?php
/**
 * Created by PhpStorm.
 * User: luan.tran
 * Date: 9/7/18
 * Time: 15:16
 */

namespace App\Http\Controllers\Admin;

use App\Components\Weapon\WeaponComponent;
use App\Components\Weapon\WeaponGroupComponent;
use App\Domains\Weapon\Master\AmmoType;
use App\Domains\Weapon\Master\WeaponFactory;
use App\Domains\Weapon\Master\WeaponGroupID;
use App\Domains\Weapon\Master\WeaponId;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class WeaponController extends Controller
{
    /**
     * @var WeaponGroupComponent
     */
    private $weaponGroupComponent;

    /**
     * @var WeaponComponent
     */
    private $weaponComponent;

    /**
     * @var WeaponFactory
     */
    private $weaponFactory;

    /**
     * WeaponController constructor.
     * @param WeaponGroupComponent $weaponGroupComponent
     * @param WeaponComponent $weaponComponent
     * @param WeaponFactory $weaponFactory
     */
    public function __construct(
        WeaponGroupComponent $weaponGroupComponent,
        WeaponComponent $weaponComponent,
        WeaponFactory $weaponFactory
    )
    {
        $this->weaponGroupComponent = $weaponGroupComponent;
        $this->weaponComponent = $weaponComponent;
        $this->weaponFactory = $weaponFactory;
    }

    public function index()
    {
        $weapons = $this->weaponComponent->getAllWeapon();
        return view('admin.weapon.list', ['weapons' => $weapons]);
    }

    public function getCreate()
    {
        $mode = 'create';
        $weaponGroups = $this->weaponGroupComponent->getAll();
        return view('admin.weapon.form', [
            'mode' => $mode,
            'weaponGroups' => $weaponGroups
        ]);
    }

    public function postCreate(Request $request)
    {
        $data = $request->input();
        $newWeapon = $this->weaponFactory->makeByArray($data);
        $this->weaponComponent->addNew($newWeapon);
        return redirect(route('admin.weapon.list'));
    }

    public function getUpdate(int $weaponId)
    {
        $weapon = $this->weaponComponent->findByID(new WeaponId($weaponId));

        if (is_null($weapon)) throw new \Exception('Not Found');

        $weapon = $weapon->toArray();
        $mode = 'update';
        $weaponGroups = $this->weaponGroupComponent->getAll();
        return view('admin.weapon.form',[
            'mode' => $mode,
            'default' => $weapon,
            'weaponGroups' => $weaponGroups
        ]);
    }

    public function postUpdate(Request $request, int $weaponId)
    {
        $params = $request->input();
        $params['id'] = $weaponId;

        $data = $this->weaponFactory->makeByArray($params);
        $this->weaponComponent->update($data);

        return redirect(route('admin.weapon.list'));
    }


    public function delete(int $weaponId)
    {
        $weapon = $this->weaponComponent->findByID(new WeaponId($weaponId));
        if(is_null($weapon)){
            return redirect(route('admin.weapon.list'));
        }
        $this->weaponComponent->delete($weapon);
        return redirect(route('admin.weapon.list'));
    }
}