@if(@Auth::user()->hasRole('consumidor'))
    <notificaciones-consumidor id_user="{{auth()->user()->id}}" user_data="{{auth()->user()}}"></notificaciones-consumidor>
@elseif(@Auth::user()->hasRole('comerciante'))
    <notificaciones-comerciante id_user="{{auth()->user()->id}}" user_data="{{auth()->user()}}"></notificaciones-comerciante>
@elseif(@Auth::user()->hasRole('administrador'))
<v-btn icon>
    <v-icon>mdi-bell</v-icon>
</v-btn>
@endif
