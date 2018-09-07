<?php
/**
 * Created by PhpStorm.
 * User: luan.tran
 * Date: 9/7/18
 * Time: 15:16
 */

namespace App\Http\Controllers\Admin;

use App\Components\Weapon\WeaponGroupComponent;
use App\Domains\Weapon\Master\AmmoType;
use App\Domains\Weapon\Master\WeaponGroupFactory;
use App\Domains\Weapon\Master\WeaponGroupID;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class WeaponGroupController extends Controller
{
    /**
     * @var WeaponGroupComponent
     */
    private $weaponGroupComponent;

    /**
     * @var WeaponGroupFactory
     */
    private $weaponGroupFactory;

    public function __construct(
        WeaponGroupComponent $weaponGroupComponent,
        WeaponGroupFactory $weaponGroupFactory
    )
    {
        $this->weaponGroupComponent = $weaponGroupComponent;
        $this->weaponGroupFactory = $weaponGroupFactory;
    }

    public function index()
    {
        $weaponGroups = $this->weaponGroupComponent->getAll();
        return view('admin.weapon.group.list', ['groups' => $weaponGroups]);
    }

    public function getCreate()
    {
        $mode = 'create';
        $ammoTypes = AmmoType::getConstList(AmmoType::class);
        return view('admin.weapon.group.form', [
                'mode' => $mode,
                'ammoTypes' => $ammoTypes
                ]);
    }

    public function postCreate(Request $request)
    {
        $data = $request->input();
        $newWeaponGroup = $this->weaponGroupFactory->makeByArray($data);
        $this->weaponGroupComponent->addNew($newWeaponGroup);
        return redirect(route('admin.weapon.group.list'));
    }

    public function getUpdate(int $weaponGroupID)
    {
        $weaponGroup = $this->weaponGroupComponent->findByID(new WeaponGroupID($weaponGroupID));

        if (is_null($weaponGroup)) throw new \Exception('Not Found');

        $group = $weaponGroup->toArray();
        $mode = 'update';
        $ammoTypes = AmmoType::getConstList(AmmoType::class);
        return view('admin.weapon.group.form',[
            'mode' => $mode,
            'default' => $group,
            'ammoTypes' => $ammoTypes
        ]);
    }

    public function postUpdate(Request $request, int $weaponGroupID)
    {
        $params = $request->input();
        $params['id'] = $weaponGroupID;

        $data = $this->weaponGroupFactory->makeByArray($params);
        $this->weaponGroupComponent->update($data);

        return redirect(route('admin.weapon.group.list'));
    }


    public function delete(int $weaponGroupID)
    {
        $weaponGroup = $this->weaponGroupComponent->findByID(new WeaponGroupID($weaponGroupID));
        if(is_null($weaponGroup)){
            return redirect(route('admin.weapon.group.list'));
        }
        $this->weaponGroupComponent->delete($weaponGroup);
        return redirect(route('admin.weapon.group.list'));
    }
}