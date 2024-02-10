//
//  inputView.swift
//  constructplanner-mobile
//
//  Created by César Van Leuffelen on 10/02/2024.
//

import SwiftUI

struct inputView: View {
    @Binding var text: String
    let title: String
    let placeholder: String
    var isSecure = false
    
    var body: some View {
        VStack (alignment: .leading, spacing: 21) {
            Text(title)
                .foregroundColor(Color(.darkGray))
                .fontWeight(.semibold)
                .font(.footnote)
            
            if isSecure {
                SecureField(placeholder, text: $text)
                    .font(.system(size: 14))
            } else {
                TextField(placeholder, text: $text)
                    .font(.system(size: 14))
            }
            
            Divider()
        }
    }
}

#Preview {
    inputView(text: .constant(""), title: "Email Address", placeholder: "name@example.com")
}
