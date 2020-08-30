import { NgModule } from '@angular/core';
import { CommonModule } from '@angular/common';
import { FormsModule } from '@angular/forms';

import { IonicModule } from '@ionic/angular';

import { SeleccionarCarreraPageRoutingModule } from './seleccionar-carrera-routing.module';

import { SeleccionarCarreraPage } from './seleccionar-carrera.page';

@NgModule({
  imports: [
    CommonModule,
    FormsModule,
    IonicModule,
    SeleccionarCarreraPageRoutingModule
  ],
  declarations: [SeleccionarCarreraPage]
})
export class SeleccionarCarreraPageModule {}
