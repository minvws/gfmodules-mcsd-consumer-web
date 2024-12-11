<table>
    <thead>
        <tr>
            @foreach ($headers as $header)
                <th>{{ $header }}</th>
            @endforeach
        </tr>
    </thead>
    <tbody>
        @foreach ($rows as $row)
            <tr>
                @foreach ($row as $cell)
                    <td>
                        @component('components.mapper-cell', ['value' => $cell])
                        @endcomponent
                    </td>
                @endforeach
            </tr>
        @endforeach
    </tbody>
</table>
