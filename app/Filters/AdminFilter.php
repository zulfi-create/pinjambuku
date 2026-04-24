<?php

namespace App\Filters;

use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\Filters\FilterInterface;

class AdminFilter implements FilterInterface
{
    /**
     * Cek apakah user sudah login DAN memiliki role admin.
     * Jika belum login, redirect ke login.
     * Jika bukan admin, redirect ke dashboard user dengan pesan error.
     */
    public function before(RequestInterface $request, $arguments = null)
    {
        $session = session();

        if (!$session->get('isLoggedIn')) {
            return redirect()->to('/login')->with('error', 'Silakan login terlebih dahulu.');
        }

        if ($session->get('role') !== 'admin') {
            return redirect()->to('/user/dashboard')->with('error', 'Anda tidak memiliki akses ke halaman admin.');
        }
    }

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        // Tidak ada aksi setelah request
    }
}
