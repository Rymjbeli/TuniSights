<?php

namespace App\Service;

use App\Entity\Post;
use Symfony\Component\Form\Extension\Core\Type\ButtonType;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\Routing\RouterInterface;

class PostService
{
    private $router;

    public function __construct(RouterInterface $router)
    {
        $this->router = $router;
    }
    public function getMessage(bool $new): string
    {
        return $new ? " is added successfully" : " is updated successfully ";
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