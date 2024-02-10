//
//  constructplanner_mobileApp.swift
//  constructplanner-mobile
//
//  Created by César Van Leuffelen on 10/02/2024.
//

import SwiftUI
import FirebaseCore


class AppDelegate: NSObject, UIApplicationDelegate {
  func application(_ application: UIApplication,
                   didFinishLaunchingWithOptions launchOptions: [UIApplication.LaunchOptionsKey : Any]? = nil) -> Bool {
    FirebaseApp.configure()

    return true
  }
}

@main
struct YourApp: App {
  // register app delegate for Firebase setup
  @UIApplicationDelegateAdaptor(AppDelegate.self) var delegate
    @StateObject var viewModel = AuthModel()

  var body: some Scene {
    WindowGroup {
        ContentView().environmentObject(viewModel)
    }
  }
}
