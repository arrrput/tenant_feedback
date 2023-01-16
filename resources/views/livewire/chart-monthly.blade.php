<div>
    {{-- Do your work, then step back. --}}
{{-- <  style="height: 400px !important;">
    <livewire:livewire-column-chart    
    :column-chart-model="$pieChartModel"
/> --}}

    <div class="shadow rounded p-4 border bg-white flex-1" style="height: 32rem;">
            @foreach ($department as $data )
                <input type="checkbox" value="{{ $data->department }}" wire:model="types"/>
                <label  class="badge badge-default">{{ $data->department }}</label>
            
            @endforeach
        

        <livewire:livewire-pie-chart
        key="{{ $pieChartModel->reactiveKey() }}"
        :pie-chart-model="$pieChartModel" />
    </div>
</div>

