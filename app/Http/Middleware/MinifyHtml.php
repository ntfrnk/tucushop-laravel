<?php
namespace App\Http\Middleware;
use Closure;
class MinifyHtml
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $response = $next($request);
        $buffer = $response->getContent();
        if(strpos($buffer,'<pre>') !== false)
        {
            $replace = array(
                '/<!--&#91;^\&#91;&#93;(.*?)&#91;^\&#93;&#93;-->/s' => '',
                "/<\?php/"                  => '<?php ',
                "/\r/"                      => '',
                "/>\n</"                    => '><',
                "/>\s+\n</"                 => '><',
                "/>\n\s+</"                 => '><',
            );
        }
        else
        {
            $replace = array(
                '/<!--&#91;^\&#91;&#93;(.*?)&#91;^\&#93;&#93;-->/s' => '',
                "/<\?php/"                  => '<?php ',
                "/\n(&#91;\S&#93;)/"                => '$1',
                "/\r/"                      => '',
                "/\n/"                      => '',
                "/\t/"                      => '',
                "/ +/"                      => ' ',
            );
        }
        $buffer = preg_replace(array_keys($replace), array_values($replace), $buffer);
        $response->setContent($buffer);
        ini_set('zlib.output_compression', 'On'); // If you like to enable GZip, too!
        return $response;
    }
}