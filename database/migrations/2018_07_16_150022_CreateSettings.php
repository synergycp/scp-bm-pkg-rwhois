<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use App\Support\Database\Migration;

use App\Setting\Setting;

class CreateSettings extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $group = $this->addSettingGroup('RWhois');

        $this->addSetting($group, Setting::TYPE_TEXT, 'pkg.rwhois.contact.poc.email');
        $this->addSetting($group, Setting::TYPE_TEXT, 'pkg.rwhois.contact.poc.name');
        $this->addSetting($group, Setting::TYPE_TEXT, 'pkg.rwhois.contact.poc.phone');

        $this->addSetting($group, Setting::TYPE_TEXT, 'pkg.rwhois.contact.tech.email');
        $this->addSetting($group, Setting::TYPE_TEXT, 'pkg.rwhois.contact.tech.name');
        $this->addSetting($group, Setting::TYPE_TEXT, 'pkg.rwhois.contact.tech.phone');

        $this->addSetting($group, Setting::TYPE_TEXT, 'pkg.rwhois.contact.abuse.email');
        $this->addSetting($group, Setting::TYPE_TEXT, 'pkg.rwhois.contact.abuse.name');
        $this->addSetting($group, Setting::TYPE_TEXT, 'pkg.rwhois.contact.abuse.phone');

        $this->addSetting($group, Setting::TYPE_CHECKBOX, 'pkg.rwhois.allow_role.poc');
        $this->addSetting($group, Setting::TYPE_CHECKBOX, 'pkg.rwhois.allow_role.tech');
        $this->addSetting($group, Setting::TYPE_CHECKBOX, 'pkg.rwhois.allow_role.abuse');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        $this->deleteSettingGroup('RWhois');
    }
}
