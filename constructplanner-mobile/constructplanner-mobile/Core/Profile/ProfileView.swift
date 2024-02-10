//
//  ProfileView.swift
//  constructplanner-mobile
//
//  Created by César Van Leuffelen on 10/02/2024.
//

import SwiftUI

struct ProfileView: View {
    @EnvironmentObject var viewModel: AuthModel
    
    var body: some View {
        if let user = viewModel.currentUser {
            List {
                Section {
                    HStack {
                        Image("logo_purplus")
                            .resizable()
                            .scaledToFit()
                            .frame(width: 72, height: 72)
                            .padding(.all, 10)
                        VStack(alignment: .leading, spacing: 4) {
                            Text(user.name)
                                .font(.subheadline)
                                .fontWeight(.semibold)
                                .padding(.top, 4)
                            Text(user.email)
                                .font(.footnote)
                                .accentColor(.gray)
                        }
                    }
                }
                Section("General") {
                    HStack {
                        SettingsRowView(imageName: "gear", title: "Version", tintColor: Color(.systemGray))
                        Spacer()
                        Text("1.0.0")
                    }
                }
                Section("Account") {
                    Button {
                        viewModel.signOut()
                    } label: {
                        SettingsRowView(imageName: "arrow.left.circle.fill", title: "Sign Out", tintColor: Color(.systemRed))
                    }
                    Button {
                        print("Load Web Version")
                    } label: {
                        SettingsRowView(imageName: "square.and.arrow.up", title: "Go to Web Version", tintColor: Color(.systemBlue))
                    }
                    
                }
            }
        }
    }
}

#Preview {
    ProfileView()
}
