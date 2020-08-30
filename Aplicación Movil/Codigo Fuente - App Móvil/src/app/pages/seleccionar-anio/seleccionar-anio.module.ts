import { NgModule } from '@angular/core';
import { CommonModule } from '@angular/common';
import { FormsModule } from '@angular/forms';

import { IonicModule } from '@ionic/angular';

import { SeleccionarAnioPageRoutingModule } from './seleccionar-anio-routing.module';

import { SeleccionarAnioPage } from './seleccionar-anio.page';

@NgModule({
  imports: [
    CommonModule,
    FormsModule,
    IonicModule,
    SeleccionarAnioPageRoutingModule
  ],
  declarations: [SeleccionarAnioPage]
})
export class SeleccionarAnioPageModule {}
