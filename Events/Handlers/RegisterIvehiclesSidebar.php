<?php

namespace Modules\Ivehicles\Events\Handlers;

use Maatwebsite\Sidebar\Group;
use Maatwebsite\Sidebar\Item;
use Maatwebsite\Sidebar\Menu;
use Modules\Core\Events\BuildingSidebar;
use Modules\User\Contracts\Authentication;

class RegisterIvehiclesSidebar implements \Maatwebsite\Sidebar\SidebarExtender
{
    /**
     * @var Authentication
     */
    protected $auth;

    /**
     * @param Authentication $auth
     *
     * @internal param Guard $guard
     */
    public function __construct(Authentication $auth)
    {
        $this->auth = $auth;
    }

    public function handle(BuildingSidebar $sidebar)
    {
        $sidebar->add($this->extendWith($sidebar->getMenu()));
    }

    /**
     * @param Menu $menu
     * @return Menu
     */
    public function extendWith(Menu $menu)
    {
        $menu->group(trans('core::sidebar.content'), function (Group $group) {
            $group->item(trans('ivehicles::ivehicles.title.ivehicles'), function (Item $item) {
                $item->icon('fa fa-copy');
                $item->weight(10);
                $item->authorize(
                     /* append */
                );
                $item->item(trans('ivehicles::vehicles.title.vehicles'), function (Item $item) {
                    $item->icon('fa fa-copy');
                    $item->weight(0);
                    $item->append('admin.ivehicles.vehicle.create');
                    $item->route('admin.ivehicles.vehicle.index');
                    $item->authorize(
                        $this->auth->hasAccess('ivehicles.vehicles.index')
                    );
                });
                $item->item(trans('ivehicles::brands.title.brands'), function (Item $item) {
                    $item->icon('fa fa-copy');
                    $item->weight(0);
                    $item->append('admin.ivehicles.brand.create');
                    $item->route('admin.ivehicles.brand.index');
                    $item->authorize(
                        $this->auth->hasAccess('ivehicles.brands.index')
                    );
                });
                $item->item(trans('ivehicles::features.title.features'), function (Item $item) {
                    $item->icon('fa fa-copy');
                    $item->weight(0);
                    $item->append('admin.ivehicles.feature.create');
                    $item->route('admin.ivehicles.feature.index');
                    $item->authorize(
                        $this->auth->hasAccess('ivehicles.features.index')
                    );
                });
                $item->item(trans('ivehicles::models.title.models'), function (Item $item) {
                    $item->icon('fa fa-copy');
                    $item->weight(0);
                    $item->append('admin.ivehicles.model.create');
                    $item->route('admin.ivehicles.model.index');
                    $item->authorize(
                        $this->auth->hasAccess('ivehicles.models.index')
                    );
                });
// append




            });
        });

        return $menu;
    }
}
