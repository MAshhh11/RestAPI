<?php

namespace App\Controller;

use App\Repository\CustomerRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\Routing\Annotation\Route;

class CustomerController extends AbstractController
{
    private $customerRepository;

    public function __construct(CustomerRepository $customerRepository)
    {
        $this->customerRepository = $customerRepository;
    }

    /**
     * @Route("/customers/", name="add_customer", methods={"POST"})
     */
    public function add(Request $request): JsonResponse
    {
        $data = json_decode($request->getContent(), true);

        $firstname = $data['firstname'];
        $lastname = $data['lastname'];
        $email = $data['email'];
        $phoneNumber = $data['phoneNumber'];

        if (empty($firstname) || empty($lastname) || empty($email) || empty($phoneNumber)) {
            throw new NotFoundHttpException('Expecting parameters');
        }
        $this->customerRepository->saveCustomer($firstname, $lastname, $email, $phoneNumber);

        return new JsonResponse(['status' => 'Customer created'], Response::HTTP_CREATED);
    }
}
