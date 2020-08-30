import { NgModule } from '@angular/core';
import { CommonModule } from '@angular/common';
import { FormsModule } from '@angular/forms';

import { IonicModule } from '@ionic/angular';

import { SeleccionarAsignaturaPageRoutingModule } from './seleccionar-asignatura-routing.module';

import { SeleccionarAsignaturaPage } from './seleccionar-asignatura.page';

@NgModule({
  imports: [
    CommonModule,
    FormsModule,
    IonicModule,
    SeleccionarAsignaturaPageRoutingModule
  ],
  declarations: [SeleccionarAsignaturaPage]
})
export class SeleccionarAsignaturaPageModule {}
