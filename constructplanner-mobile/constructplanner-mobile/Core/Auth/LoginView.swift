//
//  LoginView.swift
//  constructplanner-mobile
//
//  Created by César Van Leuffelen on 10/02/2024.
//

import SwiftUI

struct LoginView: View {
    @State private var email = ""
    @State private var password = ""
    @EnvironmentObject var viewModel: AuthModel
    
    var body: some View {
        NavigationStack {
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
                    inputView(text: $password, title: "Password", placeholder: "Enter Your Password", isSecure: true)
                        .autocapitalization(.none)
                        .autocorrectionDisabled()
                }
                .padding(.horizontal)
                .padding(.top, 22)
                // sign in Button
                Button {
                    Task {
                        try await viewModel.signIn(withEmail: email, password: password)
                    }
                } label: {
                    HStack {
                        Text("SIGN IN")
                            .fontWeight(.semibold)
                        Image(systemName: "arrow.right")
                    }
                    .foregroundStyle(Color(.white))
                    .frame(width: UIScreen.main.bounds.width - 32, height: 48)
                }
                .background(Color(.systemBlue))
                .disabled(!formIsValid)
                .opacity(formIsValid ? 1 : 0.5)
                .cornerRadius(10)
                .padding(.top, 30)
                
                Spacer()
                
                // sign up nav
                // NavigationLink {
                //    RegisterView()
                //        .navigationBarBackButtonHidden()
                // } label: {
                //    HStack(spacing: 3) {
                //        Text("Don't have an account?")
                //        Text("Sign up")
                //            .fontWeight(.bold)
                //    }
                //    .font(.system(size: 14))
                //    .foregroundStyle(Color(.systemBlue))
                // }
            }
        }
    }
}

extension LoginView: AuthFormProtocol {
    var formIsValid: Bool {
        return !email.isEmpty
        && email.contains("@")
        && !password.isEmpty
        && password.count > 5
    }
    
    
}

#Preview {
    LoginView()
}
