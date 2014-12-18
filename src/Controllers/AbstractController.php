<?php

/**
 * This file is part of Yeh by Graham Campbell.
 *
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
 * IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
 * FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
 * AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
 * LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
 * OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN
 * THE SOFTWARE.
 */

namespace GrahamCampbell\Yeh\Controllers;

use Proton\Application;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

abstract class AbstractController
{
    protected $app;
    protected $request;
    protected $response;
    protected $args;

    public function __construct(Application $app)
    {
        $this->app = $app;
    }

    public function index(Request $request, Response $response, array $args)
    {
        $this->request = $request;
        $this->response = $response;
        $this->args = $args;

        return $this->fire();
    }

    protected abstract function fire();

    protected function success($data, $code = 200)
    {
        $this->response->setStatusCode($code);
        $this->response->headers->add(['Content-Type' => 'application/json']);
        $this->response->setContent(json_encode(['success' => $data], JSON_PRETTY_PRINT));

        return $this->response;
    }

    protected function redirect($url, $code = 302)
    {
        $this->response->setStatusCode($code);
        $this->response->headers->set('Location', $url);

        return $this->response;
    }

    protected function error($data, $code = 500)
    {
        $this->response->setStatusCode($code);
        $this->response->headers->add(['Content-Type' => 'application/json']);
        $this->response->setContent(json_encode(['error' => $data], JSON_PRETTY_PRINT));

        return $this->response;
    }

    protected function image($data, $mime)
    {
        $this->response->headers->add(['Content-Type' => $mime]);
        $this->response->setContent($data);

        return $this->response;
    }

    protected function input($key)
    {
        return $this->request->request->get($key);
    }

    protected function file($key)
    {
        return $this->request->files->get($key);
    }

}
