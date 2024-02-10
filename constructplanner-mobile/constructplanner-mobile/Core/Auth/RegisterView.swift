//
//  RegisterView.swift
//  constructplanner-mobile
//
//  Created by César Van Leuffelen on 10/02/2024.
//

import SwiftUI

struct RegisterView: View {
    @State private var email = ""
    @State private var name = ""
    @State private var password = ""
    @State private var confirm = ""
    @Environment(\.dismiss) var dismiss
    @EnvironmentObject var viewModel: AuthModel
    
    var body: some View {
        VStack {
            // Image
            Image("logo_purplus")
                .resizable()
                .scaledToFill()
                .frame(width: /*@START_MENU_TOKEN@*/100/*@END_MENU_TOKEN@*/, height: 120)
                .padding(.vertical, 32)
            // Form fields
            VStack (spacing: 24) {
                inputView(text: $email, title: "Email Address", placeholder: "name@example.com")
                    .autocapitalization(.none)
                inputView(text: $name, title: "Name", placeholder: "company name")
                inputView(text: $password, title: "Password", placeholder: "Enter Your Password", isSecure: true)
                    .autocapitalization(.none)
                    .autocorrectionDisabled()
                inputView(text: $confirm, title: "Confirm Password", placeholder: "Enter Your Password Again", isSecure: true)
                    .autocapitalization(.none)
                    .autocorrectionDisabled()
            }
            .padding(.horizontal)
            .padding(.top, 22)
            // sign in Button
            Button {
                Task {
                    try await viewModel.signUp(withEmail: email, password: password, name: name)
                }
            } label: {
                HStack {
                    Text("SIGN UP")
                        .fontWeight(.semibold)
                    Image(systemName: "arrow.right")
                }
                .foregroundStyle(Color(.white))
                .frame(width: UIScreen.main.bounds.width - 32, height: 48)
            }
            .background(Color(.systemBlue))
            .cornerRadius(10)
            .padding(.top, 30)
            
            Spacer()
            
            // sign up Button
            Button {
                dismiss()
            } label: {
                HStack(spacing: 3) {
                    Text("Already have an account?")
                    Text("Login")
                        .fontWeight(.bold)
                }
                .font(.system(size: 14))
                .foregroundStyle(Color(.systemBlue))
            }
            
        }
    }
}
    
    #Preview {
        RegisterView()
    }
