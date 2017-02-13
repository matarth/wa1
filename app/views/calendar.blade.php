@extends('layouts.default')

@section('content')

    <h1>
        Kalendář akcí
    </h1>

    <table class=kalendar>
        <tr>
            <td colspan="7">
                <h2>
                    {{ $rok }}
                </h2>
            </td>
        </tr>

        <tr class=firstRow>
            <td colspan="2" class="previousMonth">
                <h2>{{ $monthDec }}  </h2>
            </td>
            <td colspan="3">
                <h1>
                    {{ $mesic }}
                </h1>
            </td>
            <td colspan="2" class="nextMonth">
                <h2>
                    {{ $monthInc }}
                </h2>
            </td>
        </tr>
        <tr class=secondRow>
            <td>
                Po
            </td>
            <td>
                Út
            </td>
            <td>
                St
            </td>
            <td>
                Čt
            </td>
            <td>
                Pá
            </td>
            <td>
                So
            </td>
            <td>
                Ne
            </td>
        </tr>

        <?php
        $count = 0;
        for ($ii = 0; $ii < 6; $ii++) {
            if ($ii != 0 && $events[$count]->getMonth() != $month) {
                break;
            }
            echo "<tr>";
            for ($jj = 0; $jj < 7; $jj++) {
                $events[$count]->printEventLink();
                $count++;
            }
            echo "</tr>";
        }
        ?>
    </table>


@stop
