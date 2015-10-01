<?
($this->bindable) ? $bindable='bindable' : $bindable='';
?>
<div class="bot <?=$this->tam.' '.$bindable?>">
    <div class="btn btn-block <?=$this->class?>" id="<?=$this->id?>">
        <span class="<?=$this->icono?>"></span>
        <span><?=$this->texto?></span>
    </div>
</div>