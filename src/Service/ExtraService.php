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
    public function getMessage(int $msgType): string
    {
        switch ($msgType) {
            case 1:
                $message = "New post is added successfully.";
                break;
            case 2:
                $message = "Your post is updated successfully.";
                break;
            case 3:
                $message = "You can not Edit this Post";
                break;
            case 4:
                $message = "Your post has been deleted successfully.";
                break;
            default:
                $message = "Invalid value for variable";
        }
        return $message;
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