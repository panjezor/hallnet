<?php


namespace App\Http\Controllers;


use App\Shortword;
use GuzzleHttp\Client;
/**
 * Class HomeController
 * @package App\Http\Controllers
 */
class HomeController extends Controller
{
    /** Default SPA load.
     * @return false|string
     */
    public function home()
    {
        return file_get_contents(public_path('_nuxt/index.html'));
    }

    /** Perform a request to get the wordlist.
     *
     */
    public function curl()
    {
        $body = $this->getWordlist('https://www.eff.org/files/2016/09/08/eff_short_wordlist_2_0.txt'); // this address could be held in the database for swapping over?
        if ($body !== '') {
            $wordlist = explode("\n", preg_filter("/([0-6]+\s)/", "", $body));
            foreach ($wordlist as $word) {
                if ($word !== '') {
                    factory(Shortword::class)->create(['short_url' => $word]);
                }
            }

        }

    }

    /** Fetch the file from the address.
     * @param $address
     * @return string
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    private function getWordlist($address){
        $client = new Client();
        $res = $client->request('GET', $address);
        $body = '';
        if ($res->getStatusCode() === 200) {
            $body = (string)$res->getBody();
        }
        return $body;
    }

    /** Convert a septenary number to decimal.
     * If there was something maybe we could actually use it, but in this case there is just no point in keeping those IDs.
     * @param int $number
     * @return int
     */
    public function sepToDec(int $number): int
    {
        $holder = 0;
        if ($number > -1) {
            $reversed = strrev((string)$number);
            $revlength = strlen($reversed);
            for ($i = 0; $i < $revlength; $i++) {
                $holder += $reversed[$i] * (7 ** $i);
            }
            return $holder;
        }
        return false;

    }
}
