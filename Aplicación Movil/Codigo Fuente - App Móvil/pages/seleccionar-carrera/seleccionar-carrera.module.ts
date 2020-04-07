import { NgModule } from '@angular/core';
import { IonicPageModule } from 'ionic-angular';
import { SeleccionarCarreraPage } from './seleccionar-carrera';

@NgModule({
  declarations: [
    SeleccionarCarreraPage,
  ],
  imports: [
    IonicPageModule.forChild(SeleccionarCarreraPage),
  ],
})
export class SeleccionarCarreraPageModule {}
