import { NgModule } from '@angular/core';
import { IonicPageModule } from 'ionic-angular';
import { SeleccionarAnioPage } from './seleccionar-anio';

@NgModule({
  declarations: [
    SeleccionarAnioPage,
  ],
  imports: [
    IonicPageModule.forChild(SeleccionarAnioPage),
  ],
})
export class SeleccionarAnioPageModule {}

