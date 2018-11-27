import { NgModule, ErrorHandler } from '@angular/core';
import { BrowserModule } from '@angular/platform-browser';
import { IonicApp, IonicModule, IonicErrorHandler } from 'ionic-angular';
import { MyApp } from './app.component';

import { AboutPage } from '../pages/about/about';
import { ContactPage } from '../pages/contact/contact';
import { HomePage } from '../pages/home/home';
import { TabsPage } from '../pages/tabs/tabs';

import { SeleccionarAnioPage } from '../pages/seleccionar-anio/seleccionar-anio';
import { SeleccionarProgramaPage } from '../pages/seleccionar-programa/seleccionar-programa';
import { SeleccionarCarreraPage } from '../pages/seleccionar-carrera/seleccionar-carrera';


import { File } from '@ionic-native/file';
import { FileTransfer } from '@ionic-native/file-transfer';
import { DocumentViewer } from '@ionic-native/document-viewer';

import {HttpModule} from '@angular/http';
import {HttpClientModule} from '@angular/common/http';

import { StatusBar } from '@ionic-native/status-bar';
import { SplashScreen } from '@ionic-native/splash-screen';
import { ServiceProvider } from '../providers/service/service';


@NgModule({
  declarations: [
    MyApp,
    AboutPage,
    ContactPage,
    HomePage,
    TabsPage,
    SeleccionarAnioPage,
    SeleccionarCarreraPage,
    SeleccionarProgramaPage
    
  ],
  imports: [
    BrowserModule,
    IonicModule.forRoot(MyApp),
    HttpModule, HttpClientModule
  ],
  bootstrap: [IonicApp],
  entryComponents: [
    MyApp,
    AboutPage,
    ContactPage,
    HomePage,
    TabsPage,
    SeleccionarCarreraPage,
    SeleccionarAnioPage,
    SeleccionarProgramaPage
    
  ],
  providers: [
    StatusBar,
    SplashScreen,
    {provide: ErrorHandler, useClass: IonicErrorHandler},
    File,
    DocumentViewer,
    FileTransfer,
    ServiceProvider
  ]
})
export class AppModule {}
