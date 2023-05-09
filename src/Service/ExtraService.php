<?php

namespace App\Service;

use App\Entity\Post;
use Symfony\Component\Form\Extension\Core\Type\ButtonType;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\Routing\RouterInterface;

class ExtraService
{
    private $router;

    public function __construct(RouterInterface $router)
    {
        $this->router = $router;
    }
    public function getMessage(bool $new = null): string
    {
        if(!$new){
            return "You can not Edit this Post";
        }
        return $new ? " New post is added successfully" : " New post is updated successfully ";
    }
    public function addDeleteButton(FormInterface $form, Post $post): FormInterface
    {
        $form->add('delete', ButtonType::class, [
            'label' => 'Delete This Post',
            'attr' => [
                'class' => 'btn btn-danger',
                'style' => $post && $post->getId() ? 'display:block;' : 'display:none;',
                'onclick' => 'location.href = "' . $this->router->generate('delete.Post', ['id' => $post->getId()]) . '";',
            ]
        ]);
        return $form;
    }
}