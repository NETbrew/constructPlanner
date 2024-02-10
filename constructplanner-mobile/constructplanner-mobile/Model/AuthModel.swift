//
//  AuthModel.swift
//  constructplanner-mobile
//
//  Created by César Van Leuffelen on 10/02/2024.
//

import Foundation
import Firebase
import FirebaseFirestoreSwift

protocol AuthFormProtocol {
    var formIsValid: Bool {get}
}

@MainActor
class AuthModel: ObservableObject {
    @Published var userSession: FirebaseAuth.User?
    @Published var currentUser: User?
    
    init() {
        self.userSession = Auth.auth().currentUser
        
        Task {
            await fetchUser()
        }
    }
    
    func signIn(withEmail email: String, password: String) async throws {
        do {
            let result = try await Auth.auth().signIn(withEmail: email, password: password)
            self.userSession = result.user
            await fetchUser()
        } catch {
            print("DEBUG: failed to login user with error \(error.localizedDescription)")
        }
    }
    
    func signUp(withEmail email: String, password: String, name: String) async throws {
        do {
            let result = try await Auth.auth().createUser(withEmail: email, password: password)
            self.userSession = result.user
            let user = User(id: result.user.uid, name: name, email: email)
            let encodedUser = try Firestore.Encoder().encode(user)
            try await Firestore.firestore().collection("users").document(user.id).setData(encodedUser)
            await fetchUser()
        } catch {
            print("DEBUG: failed to create user with error \(error.localizedDescription)")
        }
    }
    
    func signOut() {
        do {
            try Auth.auth().signOut() // sings out user on backend
            self.userSession = nil // wipes out user session and takes us back to login
            self.currentUser = nil // wipes out current user data model
        } catch {
            print("DEBUG: failed to sign out with error \(error.localizedDescription)")
        }
    }
    
    func fetchUser() async {
        guard let uid = Auth.auth().currentUser?.uid else {return}
        guard let snapshot = try? await Firestore.firestore().collection("users").document(uid).getDocument() else {return}
        self.currentUser = try? snapshot.data(as: User.self)
        
        print("DEBUG: current user is \(String(describing: self.currentUser))")
    }
}
