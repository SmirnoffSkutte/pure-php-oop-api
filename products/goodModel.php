<?php

class GoodModel{
    private ?int $id=null;
    public ?string $name=null;
    public ?int $price=null;
    public ?string $image=null;
    public ?string $info=null;
    public ?int $categoryId=null;
    public ?int $brandId=null;

    public function setId(int $id){
        $this->id=$id;
    }

    public function createArrayOfVars():array{
        $arr=[
            'id'=>$this->id,
            'name'=>$this->name,
            'price'=>$this->price,
            'image'=>$this->image,
            'info'=>$this->info,
            'categoryId'=>$this->categoryId,
            'brandId'=>$this->brandId
        ];
        return $arr;
    }
}