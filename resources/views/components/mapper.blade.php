<table class="table-auto w-full">
    <thead>
        <tr>
            @foreach ($columns as $column)
                <th class="px-4 py-2">{{ $column }}</th>
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
