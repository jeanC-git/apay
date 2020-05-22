@if(@Auth::user()->hasRole('consumidor'))
<v-list-item href="#">
    <v-list-item-icon>
        <v-icon>mdi-account-circle</v-icon>
    </v-list-item-icon>
    <v-list-item-content>
        <v-list-item-title>Información personal</v-list-item-title>
    </v-list-item-content>
</v-list-item>
<v-list-item href="#">
    <v-list-item-icon>
        <v-icon>mdi-note</v-icon>
    </v-list-item-icon>
    <v-list-item-content>
        <v-list-item-title>Listas de compras</v-list-item-title>
    </v-list-item-content>
</v-list-item>
<v-list-item href="#">
    <v-list-item-icon>
        <v-icon>mdi-cart</v-icon>
    </v-list-item-icon>
    <v-list-item-content>
        <v-list-item-title>Mi lista</v-list-item-title>
    </v-list-item-content>
</v-list-item>
<v-list-item href="#">
    <v-list-item-icon>
        <v-icon>mdi-security</v-icon>
    </v-list-item-icon>
    <v-list-item-content>
        <v-list-item-title>Reglas de adquisión</v-list-item-title>
    </v-list-item-content>
</v-list-item>
@elseif(@Auth::user()->hasRole('comerciante'))
<v-list-item href="/home">
    <v-list-item-icon>
        <v-icon>mdi-account-multiple</v-icon>
    </v-list-item-icon>
    <v-list-item-content>
        <v-list-item-title>Información personal</v-list-item-title>
    </v-list-item-content>
</v-list-item>
<v-list-item href="/registro-puesto">
    <v-list-item-icon>
        <v-icon>mdi-shopping</v-icon>
    </v-list-item-icon>
    <v-list-item-content>
        <v-list-item-title>Negocios</v-list-item-title>
    </v-list-item-content>
</v-list-item>
<v-list-item href="#">
    <v-list-item-icon>
        <v-icon>mdi-folder</v-icon>
    </v-list-item-icon>
    <v-list-item-content>
        <v-list-item-title>Gestión de productos</v-list-item-title>
    </v-list-item-content>
</v-list-item>
<v-list-item href="#">
    <v-list-item-icon>
        <v-icon>mdi-note</v-icon>
    </v-list-item-icon>
    <v-list-item-content>
        <v-list-item-title>Listas de compras</v-list-item-title>
    </v-list-item-content>
</v-list-item>
@elseif(@Auth::user()->hasRole('administrador'))
<v-list-item href="/consumidores">
    <v-list-item-icon>
        <v-icon>mdi-note</v-icon>
    </v-list-item-icon>
    <v-list-item-content>
        <v-list-item-title>Consumidores</v-list-item-title>
    </v-list-item-content>
</v-list-item>
<v-list-item href="/comerciantes">
    <v-list-item-icon>
        <v-icon>mdi-folder</v-icon>
    </v-list-item-icon>
    <v-list-item-content>
        <v-list-item-title>Comerciantes</v-list-item-title>
    </v-list-item-content>
</v-list-item>
@endif
