<?php

namespace syouyu\join\form;

use pocketmine\form\Form;
use pocketmine\Player;
use syouyu\join\Main;
use pocketmine\Server;
use pocketmine\level\Position;
use pocketmine\Entity;

class CustomForm implements Form{

    public function __construct(Main $main){
	$this->main = $main;
    }

    public function handleResponse(Player $player, $data): void{
        if ($data === null){
            $player->sendForm(new CustomForm($this->main));
            return;
	}elseif(isset($data[0])){
	    if($data[0] == "ぎょうざ"){
		$name = $player->getName();
                $player->setImmobile(false);
                $this->main->config->set($name, $name);
                $this->main->config->save();
                return;
            }else{
                $player->sendForm(new CustomForm($this->main));
	    }
        }else{
	    $player->sendForm(new CustomForm($this->main));
	}
    }

    public function jsonSerialize(){
        return[
            'type' => 'custom_form',
            'title' => 'password',
            'content' => [
                [
                    'type' => 'input',
                    'text' => 'passwordを入力してください'
                ]
            ]
        ];
    }
}