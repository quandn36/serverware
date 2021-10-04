<div class="page-title-box">
    <div class="row align-items-center">
        @php
        if(isset($pageInfo['dashboard'])) {
            $title = Str::ucfirst($pageInfo['page']);    
        } else {
            $title = Str::ucfirst(Str::plural($pageInfo['page']));
        }
        @endphp
        {{-- <div class="col-sm-6">
            @if(isset( $pageInfo['subtitle']))
            <h4 class="page-title">
                @if(isset( $pageInfo['namepage']))
                {{ $pageInfo['subtitle'] }} {{ $pageInfo['namepage'] }}
                @else
                {{ $pageInfo['subtitle'] }} {{ $pageInfo['page'] }}
                @endif
            @if(isset( $pageInfo['categorytree']))for {{
            $pageInfo['categorytree'] }}  @endif

            @if(isset( $pageInfo['category'])) for category: {{
            $pageInfo['category'] }}  @endif
            </h4>
            
            @else
            <h4 class="page-title">{{ $title }}</h4>
            @endif
        </div> --}}
        <div class="col-sm-12">
            <ol class="breadcrumb" style="font-size: 15px;">
                {{-- <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">dashboard</a></li> --}}
                @if(isset( $pageInfo['parent']))
                    <li class="breadcrumb-item"><a href="{{ route($pageInfo['parent'].'.list') }}">{{ Str::ucfirst(Str::plural($pageInfo['parent'])) }}</a></li>
                @endif
                @if(isset( $pageInfo['subtitle']))
                <li class="breadcrumb-item"><a href="{{ route($pageInfo['page'].'.list') }}">
                    @if(isset( $pageInfo['namepage']))
                    @php $title = Str::ucfirst(Str::plural($pageInfo['namepage']))
                    @endphp
                    {{ $title }}
                    @else
                    {{ $title }}
                    @endif
                </a></li>
                <li class="breadcrumb-item active">{{ $pageInfo['subtitle'] }}</li>
                @else
                <li class="breadcrumb-item active">{{ $title }}</li>
                @endif
            </ol>
        </div>
    </div> <!-- end row -->
</div>
<!-- end page-title -->