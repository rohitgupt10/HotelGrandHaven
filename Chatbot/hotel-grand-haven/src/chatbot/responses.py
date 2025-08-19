def get_response(intent):
    responses = {
        "Greeting": "Welcome to Hotel Grand Haven! How can I help you today?",
        "Goodbye": "Goodbye! Have a great day, and we hope to welcome you soon.",
        "Thanks": "You’re welcome! Is there anything else I can help you with?",
        "Help": "I can help with availability, bookings, prices, facilities, policies, and more. What would you like to know?",
        "Room_Availability": "Please share your check-in and check-out dates and number of guests, and I’ll check availability.",
        "Booking_Request": "Sure — please provide check-in, check-out, number of guests, and preferred room type to proceed with booking.",
        "Facility_Query": "We offer Wi‑Fi, AC, room service, toiletries, and more. Tell me which facilities you’re looking for.",
        "Cancellation": "You can cancel by sharing your booking reference. Our cancellation terms may apply depending on timing.",
        "Room_Count": "We have 20 rooms in total, including standard, deluxe, suite, and Royal Suite categories.",
        "Pricing_Info": "Rates vary by dates and room type. Share your dates and room preference for an exact price.",
        "Checkin_Time": "Standard check-in is at 2:00 PM.",
        "Checkout_Time": "Standard check-out is at 12:00 PM.",
        "Early_Checkin": "Early check-in is subject to availability and may incur a fee. What time do you plan to arrive?",
        "Late_Checkout": "Late check-out is subject to availability and may incur a fee. What time do you need?",
        "Payment_Methods": "We accept major credit/debit cards and online payments. Share your preferred method.",
        "Modify_Booking": "Provide your booking reference and the new dates/details you want to change.",
        "Booking_Status": "Share your booking reference, and I will check the status for you.",
        "Refund_Policy": "Refunds depend on the cancellation window. Please share your booking reference and cancellation date.",
        "Extra_Bed": "We can provide an extra bed or baby cot for select rooms, subject to availability and an extra charge.",
        "Default": "I’m not sure I understood. Could you rephrase or provide a few more details?",
    }
    return responses.get(intent, responses["Default"])
