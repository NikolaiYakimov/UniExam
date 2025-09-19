// import { useState, useEffect } from 'react';
// import { useAuth } from '../hooks/useAuth';
// import Header from './Header';
// import Sidebar from './Sidebar';
//
// export default function Exams() {
//     const { user, token } = useAuth();
//     const [exams, setExams] = useState([]);
//     const [loading, setLoading] = useState(true);
//     const [error, setError] = useState(null);
//
//     useEffect(() => {
//         fetchExams();
//     }, []);
//
//     const fetchExams = async () => {
//         try {
//             const response = await fetch('http://localhost:8000/api/exams', {
//                 headers: {
//                     'Authorization': `Bearer ${token}`,
//                     'Accept': 'application/json',
//                 }
//             });
//
//             if (!response.ok) {
//                 throw new Error('Грешка при зареждане на изпитите');
//             }
//
//             const data = await response.json();
//
//             // Проверка на структурата на отговора
//             console.log('API Response:', data); // За дебъг
//
//             // Ако отговорът има свойство data, използваме него
//             if (data.data && Array.isArray(data.data)) {
//                 setExams(data.data);
//             }
//             // Ако отговорът е директен масив
//             else if (Array.isArray(data)) {
//                 setExams(data);
//             }
//             // Ако отговорът има свойство exams
//             else if (data.exams && Array.isArray(data.exams)) {
//                 setExams(data.exams);
//             }
//             // В противен случай задаваме празен масив
//             else {
//                 setExams([data]);
//                 // setError('Неочакван формат на данните');
//             }
//         } catch (err) {
//             setError(err.message);
//             setExams([]); // Уверяваме се, че exams винаги е масив
//         } finally {
//             setLoading(false);
//         }
//     };
//
//     const handleRegister = async (examId, requiresPayment = false) => {
//         try {
//             if (requiresPayment) {
//                 // Логика за плащане
//                 console.log('Иницииране на плащане за изпит:', examId);
//                 // Тук ще имплементирате логиката за плащане със Stripe
//             } else {
//                 const response = await fetch(`http://localhost:8000/api/exams/${examId}/register`, {
//                     method: 'POST',
//                     headers: {
//                         'Authorization': `Bearer ${token}`,
//                         'Content-Type': 'application/json',
//                     }
//                 });
//
//                 if (!response.ok) {
//                     throw new Error('Грешка при записване за изпита');
//                 }
//
//                 const result = await response.json();
//                 alert(result.message || 'Успешно се записахте за изпита!');
//                 fetchExams(); // Презареждане на изпитите
//             }
//         } catch (err) {
//             setError(err.message);
//         }
//     };
//
//     if (loading) {
//         return (
//             <div className="min-h-screen bg-gradient-to-br from-indigo-50 to-blue-50 flex items-center justify-center">
//                 <div className="text-center">
//                     <div className="spinner-border text-primary" role="status">
//                         <span className="visually-hidden">Зареждане...</span>
//                     </div>
//                     <p className="mt-3 text-gray-600">Зареждане на изпити...</p>
//                 </div>
//             </div>
//         );
//     }
//
//     if (error) {
//         return (
//             <div className="min-h-screen bg-gradient-to-br from-indigo-50 to-blue-50 flex items-center justify-center">
//                 <div className="text-center p-6 bg-white rounded-lg shadow-md">
//                     <i className="fas fa-exclamation-triangle text-4xl text-red-500 mb-4"></i>
//                     <h3 className="text-lg font-medium text-gray-700 mb-2">Грешка</h3>
//                     <p className="text-gray-500">{error}</p>
//                     <button
//                         onClick={fetchExams}
//                         className="mt-4 px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700"
//                     >
//                         Опитайте отново
//                     </button>
//                 </div>
//             </div>
//         );
//     }
//
//     return (
//         <div className="bg-gradient-to-br from-indigo-50 to-blue-50 min-h-screen overflow-x-hidden">
//             <Header />
//
//             <div className="page-layout flex">
//                 <Sidebar user={user} />
//
//                 <main className="p-4 lg:p-6 flex-1">
//                     <div className="bg-white/90 backdrop-blur-md shadow-sm py-4 mb-6 rounded-xl border border-gray-100">
//                         <div className="flex flex-col md:flex-row justify-between items-start md:items-center px-6 gap-4">
//                             <div>
//                                 <h1 className="text-2xl font-bold text-gray-800">Достъпни изпити</h1>
//                                 <p className="text-sm text-gray-500 mt-1">Преглед и записване за предстоящи изпити</p>
//                             </div>
//                             <a
//                                 href="/my-exams"
//                                 className="inline-flex items-center gap-1 px-4 py-2.5 bg-green-500 text-white rounded-lg shadow hover:bg-green-600 transition-colors"
//                             >
//                                 <i className="fas fa-list-alt"></i>
//                                 Моите изпити
//                             </a>
//                         </div>
//                     </div>
//
//                     {(!exams || exams.length === 0) ? (
//                         <div className="text-center p-8 bg-white border border-gray-100 shadow-sm rounded-xl">
//                             <i className="fas fa-calendar-times text-4xl text-gray-300 mb-4"></i>
//                             <h3 className="text-lg font-medium text-gray-700 mb-2">Няма налични изпити</h3>
//                             <p className="text-gray-500">В момента няма изпити за записване. Моля, проверете по-късно.</p>
//                         </div>
//                     ) : (
//                         <div className="grid gap-6 grid-cols-1 sm:grid-cols-2 xl:grid-cols-3">
//                             {exams.map((exam) => {
//                                 const requiresPayment = exam.exam_type === 'ликвидация' ||
//                                     (exam.subject && exam.subject.semester < user.student.semester);
//
//                                 return (
//                                     <div key={exam.id} className="bg-white border border-gray-100 rounded-xl p-4 sm:p-6 hover:shadow-md transition-all hover:border-indigo-100 hover:-translate-y-0.5">
//                                         <div className="flex flex-col sm:flex-row sm:justify-between items-start gap-2 mb-3">
//                                             <h2 className="text-lg font-semibold text-gray-900 leading-tight">
//                                                 {exam.subject?.subject_name || 'Неизвестен предмет'}
//                                             </h2>
//                                             <div className="flex flex-wrap gap-2">
//                         <span className="px-2.5 py-1 rounded-full text-xs font-medium bg-purple-100 text-purple-800">
//                           {exam.exam_type}
//                         </span>
//                                                 <span className={`px-2.5 py-1 rounded-full text-xs font-medium ${
//                                                     exam.remaining_slots > 0 ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800'
//                                                 }`}>
//                           {exam.remaining_slots > 0 ? `${exam.remaining_slots} Свободни места` : 'Няма места'}
//                         </span>
//                                             </div>
//                                         </div>
//
//                                         <div className="space-y-3 mb-5">
//                                             <div className="flex items-center gap-2 text-gray-600">
//                                                 <i className="fas fa-chalkboard-teacher w-5 text-gray-400"></i>
//                                                 <span>Преподавател: <span className="font-medium text-gray-800">
//                           {exam.teacher?.user?.first_name} {exam.teacher?.user?.last_name}
//                         </span></span>
//                                             </div>
//                                             <div className="flex items-center gap-2 text-gray-600">
//                                                 <i className="fas fa-calendar-alt w-5 text-gray-400"></i>
//                                                 <span>Дата: <span className="font-medium text-gray-800">
//                           {new Date(exam.start_time).toLocaleDateString('bg-BG')}
//                         </span></span>
//                                             </div>
//                                             <div className="flex items-center gap-2 text-gray-600">
//                                                 <i className="fas fa-clock w-5 text-gray-400"></i>
//                                                 <span>Продължителност: <span className="font-medium text-gray-800">
//                           {new Date(exam.start_time).toLocaleTimeString('bg-BG', { hour: '2-digit', minute: '2-digit' })} -
//                                                     {new Date(exam.end_time).toLocaleTimeString('bg-BG', { hour: '2-digit', minute: '2-digit' })}
//                         </span></span>
//                                             </div>
//                                             <div className="flex items-center gap-2 text-gray-600">
//                                                 <i className="fas fa-university w-5 text-gray-400"></i>
//                                                 <span>Зала: <span className="font-medium text-gray-800">{exam.hall?.name}</span></span>
//                                             </div>
//                                         </div>
//
//                                         <button
//                                             onClick={() => handleRegister(exam.id, requiresPayment)}
//                                             disabled={exam.remaining_slots <= 0}
//                                             className={`w-full px-4 py-2.5 rounded-xl text-white font-medium transition-colors duration-200 ${
//                                                 exam.remaining_slots <= 0
//                                                     ? 'bg-gray-300 cursor-not-allowed'
//                                                     : requiresPayment
//                                                         ? 'bg-blue-600 hover:bg-blue-700'
//                                                         : 'bg-green-600 hover:bg-green-700'
//                                             }`}
//                                         >
//                                             <i className={`mr-2 ${requiresPayment ? 'fas fa-credit-card' : 'fas fa-edit'}`}></i>
//                                             {requiresPayment ? 'Плати и се запиши' : 'Запиши се'}
//                                         </button>
//                                     </div>
//                                 );
//                             })}
//                         </div>
//                     )}
//                 </main>
//             </div>
//         </div>
//     );
// }
// import { useState, useEffect } from 'react';
// import { useAuth } from '../hooks/useAuth';
// import Header from './Header';
// import Sidebar from './Sidebar';
//
// export default function Exams() {
//     const { user, token } = useAuth();
//     const [exams, setExams] = useState([]);
//     const [loading, setLoading] = useState(true);
//     const [error, setError] = useState(null);
//
//     useEffect(() => {
//         fetchExams();
//     }, []);
//
//     const fetchExams = async () => {
//         try {
//             const response = await fetch('http://localhost:8000/api/exams', {
//                 headers: {
//                     'Authorization': `Bearer ${token}`,
//                     'Accept': 'application/json',
//                 }
//             });
//
//             if (!response.ok) {
//                 throw new Error(`Грешка при зареждане на изпитите: ${response.status}`);
//             }
//
//             const data = await response.json();
//
//             // Проверка на различни формати на отговора
//             let examsData = [];
//
//             if (Array.isArray(data)) {
//                 // Ако API връща директно масив
//                 examsData = data;
//             } else if (data.data && Array.isArray(data.data)) {
//                 // Ако API връща { data: [...] }
//                 examsData = data.data;
//             } else if (data.exams && Array.isArray(data.exams)) {
//                 // Ако API връща { exams: [...] }
//                 examsData = data.exams;
//             } else {
//                 throw new Error('Неочакван формат на данните от сървъра');
//             }
//
//             setExams(examsData);
//         } catch (err) {
//             console.error('Грешка при зареждане на изпити:', err);
//             setError(err.message);
//         } finally {
//             setLoading(false);
//         }
//     };
//
//     const handleRegister = async (examId, requiresPayment = false) => {
//         try {
//             if (requiresPayment) {
//                 console.log('Иницииране на плащане за изпит:', examId);
//                 // Тук ще имплементирате логиката за плащане със Stripe
//             } else {
//                 const response = await fetch(`http://localhost:8000/api/exams/${examId}/register`, {
//                     method: 'POST',
//                     headers: {
//                         'Authorization': `Bearer ${token}`,
//                         'Content-Type': 'application/json',
//                     }
//                 });
//
//                 if (!response.ok) {
//                     const errorData = await response.json();
//                     throw new Error(errorData.message || 'Грешка при записване за изпита');
//                 }
//
//                 const result = await response.json();
//                 alert(result.message || 'Успешно се записахте за изпита!');
//                 fetchExams(); // Презареждане на изпитите
//             }
//         } catch (err) {
//             setError(err.message);
//         }
//     };
//
//     if (loading) {
//         return (
//             <div className="min-h-screen bg-gradient-to-br from-indigo-50 to-blue-50 flex items-center justify-center">
//                 <div className="text-center">
//                     <div className="spinner-border text-primary" role="status">
//                         <span className="visually-hidden">Зареждане...</span>
//                     </div>
//                     <p className="mt-3 text-gray-600">Зареждане на изпити...</p>
//                 </div>
//             </div>
//         );
//     }
//
//     if (error) {
//         return (
//             <div className="min-h-screen bg-gradient-to-br from-indigo-50 to-blue-50 flex items-center justify-center">
//                 <div className="text-center p-6 bg-white rounded-lg shadow-md">
//                     <i className="fas fa-exclamation-triangle text-4xl text-red-500 mb-4"></i>
//                     <h3 className="text-lg font-medium text-gray-700 mb-2">Грешка</h3>
//                     <p className="text-gray-500">{error}</p>
//                     <button
//                         onClick={fetchExams}
//                         className="mt-4 px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700"
//                     >
//                         Опитайте отново
//                     </button>
//                 </div>
//             </div>
//         );
//     }
//
//     return (
//         <div className="bg-gradient-to-br from-indigo-50 to-blue-50 min-h-screen overflow-x-hidden">
//             <Header />
//
//             <div className="page-layout flex">
//                 <Sidebar user={user} />
//
//                 <main className="p-4 lg:p-6 flex-1">
//                     <div className="bg-white/90 backdrop-blur-md shadow-sm py-4 mb-6 rounded-xl border border-gray-100">
//                         <div className="flex flex-col md:flex-row justify-between items-start md:items-center px-6 gap-4">
//                             <div>
//                                 <h1 className="text-2xl font-bold text-gray-800">Достъпни изпити</h1>
//                                 <p className="text-sm text-gray-500 mt-1">Преглед и записване за предстоящи изпити</p>
//                             </div>
//                             <a
//                                 href="/my-exams"
//                                 className="inline-flex items-center gap-1 px-4 py-2.5 bg-green-500 text-white rounded-lg shadow hover:bg-green-600 transition-colors"
//                             >
//                                 <i className="fas fa-list-alt"></i>
//                                 Моите изпити
//                             </a>
//                         </div>
//                     </div>
//
//                     {!exams || exams.length === 0 ? (
//                         <div className="text-center p-8 bg-white border border-gray-100 shadow-sm rounded-xl">
//                             <i className="fas fa-calendar-times text-4xl text-gray-300 mb-4"></i>
//                             <h3 className="text-lg font-medium text-gray-700 mb-2">Няма налични изпити</h3>
//                             <p className="text-gray-500">В момента няма изпити за записване. Моля, проверете по-късно.</p>
//                         </div>
//                     ) : (
//                         <div className="grid gap-6 grid-cols-1 sm:grid-cols-2 xl:grid-cols-3">
//                             {exams.map((exam) => {
//                                 const requiresPayment = exam.exam_type === 'ликвидация' ||
//                                     (exam.subject && exam.subject.semester < user.student.semester);
//
//                                 return (
//                                     <div key={exam.id} className="bg-white border border-gray-100 rounded-xl p-4 sm:p-6 hover:shadow-md transition-all hover:border-indigo-100 hover:-translate-y-0.5">
//                                         <div className="flex flex-col sm:flex-row sm:justify-between items-start gap-2 mb-3">
//                                             <h2 className="text-lg font-semibold text-gray-900 leading-tight">
//                                                 {exam.subject?.subject_name || 'Неизвестен предмет'}
//                                             </h2>
//                                             <div className="flex flex-wrap gap-2">
//                         <span className="px-2.5 py-1 rounded-full text-xs font-medium bg-purple-100 text-purple-800">
//                           {exam.exam_type}
//                         </span>
//                                                 <span className={`px-2.5 py-1 rounded-full text-xs font-medium ${
//                                                     exam.remaining_slots > 0 ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800'
//                                                 }`}>
//                           {exam.remaining_slots > 0 ? `${exam.remaining_slots} Свободни места` : 'Няма места'}
//                         </span>
//                                             </div>
//                                         </div>
//
//                                         <div className="space-y-3 mb-5">
//                                             <div className="flex items-center gap-2 text-gray-600">
//                                                 <i className="fas fa-chalkboard-teacher w-5 text-gray-400"></i>
//                                                 <span>Преподавател: <span className="font-medium text-gray-800">
//                           {exam.teacher?.user?.first_name} {exam.teacher?.user?.last_name}
//                         </span></span>
//                                             </div>
//                                             <div className="flex items-center gap-2 text-gray-600">
//                                                 <i className="fas fa-calendar-alt w-5 text-gray-400"></i>
//                                                 <span>Дата: <span className="font-medium text-gray-800">
//                           {new Date(exam.start_time).toLocaleDateString('bg-BG')}
//                         </span></span>
//                                             </div>
//                                             <div className="flex items-center gap-2 text-gray-600">
//                                                 <i className="fas fa-clock w-5 text-gray-400"></i>
//                                                 <span>Продължителност: <span className="font-medium text-gray-800">
//                           {new Date(exam.start_time).toLocaleTimeString('bg-BG', { hour: '2-digit', minute: '2-digit' })} -
//                                                     {new Date(exam.end_time).toLocaleTimeString('bg-BG', { hour: '2-digit', minute: '2-digit' })}
//                         </span></span>
//                                             </div>
//                                             <div className="flex items-center gap-2 text-gray-600">
//                                                 <i className="fas fa-university w-5 text-gray-400"></i>
//                                                 <span>Зала: <span className="font-medium text-gray-800">{exam.hall?.name}</span></span>
//                                             </div>
//                                         </div>
//
//                                         <button
//                                             onClick={() => handleRegister(exam.id, requiresPayment)}
//                                             disabled={exam.remaining_slots <= 0}
//                                             className={`w-full px-4 py-2.5 rounded-xl text-white font-medium transition-colors duration-200 ${
//                                                 exam.remaining_slots <= 0
//                                                     ? 'bg-gray-300 cursor-not-allowed'
//                                                     : requiresPayment
//                                                         ? 'bg-blue-600 hover:bg-blue-700'
//                                                         : 'bg-green-600 hover:bg-green-700'
//                                             }`}
//                                         >
//                                             <i className={`mr-2 ${requiresPayment ? 'fas fa-credit-card' : 'fas fa-edit'}`}></i>
//                                             {requiresPayment ? 'Плати и се запиши' : 'Запиши се'}
//                                         </button>
//                                     </div>
//                                 );
//                             })}
//                         </div>
//                     )}
//                 </main>
//             </div>
//         </div>
//     );
// }
// import { useState, useEffect } from 'react';
// import { useAuth } from '../hooks/useAuth';
// import Header from './Header';
// import Sidebar from './Sidebar';
// import './Exam.css'
//
// export default function Exams() {
//     const { user, token } = useAuth();
//     const [exams, setExams] = useState([]);
//     const [loading, setLoading] = useState(true);
//     const [error, setError] = useState(null);
//
//     useEffect(() => {
//         fetchExams();
//     }, []);
//
//     const fetchExams = async () => {
//         try {
//             const response = await fetch('http://localhost:8000/api/exams', {
//                 headers: {
//                     'Authorization': `Bearer ${token}`,
//                     'Accept': 'application/json',
//                 }
//             });
//
//             if (!response.ok) {
//                 throw new Error(`Грешка при зареждане на изпитите: ${response.status}`);
//             }
//
//             const data = await response.json();
//
//             // Проверка на различни формати на отговора
//             let examsData = [];
//
//             if (data.data) {
//                 // Ако data е обект, вземаме всичките му стойности
//                 if (typeof data.data === 'object' && !Array.isArray(data.data)) {
//                     examsData = Object.values(data.data);
//                 }
//                 // Ако data е масив
//                 else if (Array.isArray(data.data)) {
//                     examsData = data.data;
//                 }
//             } else if (Array.isArray(data)) {
//                 // Ако API връща директно масив
//                 examsData = data;
//             } else if (data.exams && Array.isArray(data.exams)) {
//                 // Ако API връща { exams: [...] }
//                 examsData = data.exams;
//             } else {
//                 throw new Error('Неочакван формат на данните от сървъра');
//             }
//
//             setExams(examsData);
//         } catch (err) {
//             console.error('Грешка при зареждане на изпити:', err);
//             setError(err.message);
//         } finally {
//             setLoading(false);
//         }
//     };
//
//     const handleRegister = async (examId, requiresPayment = false) => {
//         try {
//             if (requiresPayment) {
//                 console.log('Иницииране на плащане за изпит:', examId);
//                 // Тук ще имплементирате логиката за плащане със Stripe
//             } else {
//                 const response = await fetch(`http://localhost:8000/api/exams/${examId}/register`, {
//                     method: 'POST',
//                     headers: {
//                         'Authorization': `Bearer ${token}`,
//                         'Content-Type': 'application/json',
//                     }
//                 });
//
//                 if (!response.ok) {
//                     const errorData = await response.json();
//                     throw new Error(errorData.message || 'Грешка при записване за изпита');
//                 }
//
//                 const result = await response.json();
//                 alert(result.message || 'Успешно се записахте за изпита!');
//                 fetchExams(); // Презареждане на изпитите
//             }
//         } catch (err) {
//             setError(err.message);
//         }
//     };
//
//     if (loading) {
//         return (
//             <div className="min-h-screen bg-gradient-to-br from-indigo-50 to-blue-50 flex items-center justify-center">
//                 <div className="text-center">
//                     <div className="spinner-border text-primary" role="status">
//                         <span className="visually-hidden">Зареждане...</span>
//                     </div>
//                     <p className="mt-3 text-gray-600">Зареждане на изпити...</p>
//                 </div>
//             </div>
//         );
//     }
//
//     if (error) {
//         return (
//             <div className="min-h-screen bg-gradient-to-br from-indigo-50 to-blue-50 flex items-center justify-center">
//                 <div className="text-center p-6 bg-white rounded-lg shadow-md">
//                     <i className="fas fa-exclamation-triangle text-4xl text-red-500 mb-4"></i>
//                     <h3 className="text-lg font-medium text-gray-700 mb-2">Грешка</h3>
//                     <p className="text-gray-500">{error}</p>
//                     <button
//                         onClick={fetchExams}
//                         className="mt-4 px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700"
//                     >
//                         Опитайте отново
//                     </button>
//                 </div>
//             </div>
//         );
//     }
//
//     return (
//         <div className="bg-gradient-to-br from-indigo-50 to-blue-50 min-h-screen overflow-x-hidden">
//             <Header />
//
//             <div className="page-layout flex">
//                 <Sidebar user={user} />
//
//                 <main className="p-4 lg:p-6 flex-1">
//                     <div className="bg-white/90 backdrop-blur-md shadow-sm py-4 mb-6 rounded-xl border border-gray-100">
//                         <div className="flex flex-col md:flex-row justify-between items-start md:items-center px-6 gap-4">
//                             <div>
//                                 <h1 className="text-2xl font-bold text-gray-800">Достъпни изпити</h1>
//                                 <p className="text-sm text-gray-500 mt-1">Преглед и записване за предстоящи изпити</p>
//                             </div>
//                             <a
//                                 href="/my-exams"
//                                 className="inline-flex items-center gap-1 px-4 py-2.5 bg-green-500 text-white rounded-lg shadow hover:bg-green-600 transition-colors"
//                             >
//                                 <i className="fas fa-list-alt"></i>
//                                 Моите изпити
//                             </a>
//                         </div>
//                     </div>
//
//                     {!exams || exams.length === 0 ? (
//                         <div className="text-center p-8 bg-white border border-gray-100 shadow-sm rounded-xl">
//                             <i className="fas fa-calendar-times text-4xl text-gray-300 mb-4"></i>
//                             <h3 className="text-lg font-medium text-gray-700 mb-2">Няма налични изпити</h3>
//                             <p className="text-gray-500">В момента няма изпити за записване. Моля, проверете по-късно.</p>
//                         </div>
//                     ) : (
//                         <div className="grid gap-6 grid-cols-1 sm:grid-cols-2 xl:grid-cols-3">
//                             {exams.map((exam) => {
//                                 // Проверка за липсващи свойства
//                                 const subjectName = exam.subject ? exam.subject.subject_name : 'Неизвестен предмет';
//                                 const teacherName = exam.teacher && exam.teacher.user ?
//                                     `${exam.teacher.user.first_name} ${exam.teacher.user.last_name}` : 'Неизвестен преподавател';
//
//                                 const requiresPayment = exam.exam_type === 'ликвидация' ||
//                                     (exam.subject && exam.subject.semester < user.student.semester);
//
//                                 return (
//                                     <div key={exam.id} className="bg-white border border-gray-100 rounded-xl p-4 sm:p-6 hover:shadow-md transition-all hover:border-indigo-100 hover:-translate-y-0.5">
//                                         <div className="flex flex-col sm:flex-row sm:justify-between items-start gap-2 mb-3">
//                                             <h2 className="text-lg font-semibold text-gray-900 leading-tight">
//                                                 {subjectName}
//                                             </h2>
//                                             <div className="flex flex-wrap gap-2">
//                         <span className="px-2.5 py-1 rounded-full text-xs font-medium bg-purple-100 text-purple-800">
//                           {exam.exam_type}
//                         </span>
//                                                 <span className={`px-2.5 py-1 rounded-full text-xs font-medium ${
//                                                     exam.remaining_slots > 0 ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800'
//                                                 }`}>
//                           {exam.remaining_slots > 0 ? `${exam.remaining_slots} Свободни места` : 'Няма места'}
//                         </span>
//                                             </div>
//                                         </div>
//
//                                         <div className="space-y-3 mb-5">
//                                             <div className="flex items-center gap-2 text-gray-600">
//                                                 <i className="fas fa-chalkboard-teacher w-5 text-gray-400"></i>
//                                                 <span>Преподавател: <span className="font-medium text-gray-800">
//                           {exam.teacher?.user?.first_name} {exam.teacher?.user?.last_name}
//                         </span></span>
//                                             </div>
//                                             <div className="flex items-center gap-2 text-gray-600">
//                                                 <i className="fas fa-calendar-alt w-5 text-gray-400"></i>
//                                                 <span>Дата: <span className="font-medium text-gray-800">
//                           {new Date(exam.start_time).toLocaleDateString('bg-BG')}
//                         </span></span>
//                                             </div>
//                                             <div className="flex items-center gap-2 text-gray-600">
//                                                 <i className="fas fa-clock w-5 text-gray-400"></i>
//                                                 <span>Продължителност: <span className="font-medium text-gray-800">
//                           {new Date(exam.start_time).toLocaleTimeString('bg-BG', { hour: '2-digit', minute: '2-digit' })} -
//                                                     {new Date(exam.end_time).toLocaleTimeString('bg-BG', { hour: '2-digit', minute: '2-digit' })}
//                         </span></span>
//                                             </div>
//                                             <div className="flex items-center gap-2 text-gray-600">
//                                                 <i className="fas fa-university w-5 text-gray-400"></i>
//                                                 <span>Зала: <span className="font-medium text-gray-800">{exam.hall?.name || 'Неизвестна зала'}</span></span>
//                                             </div>
//                                         </div>
//
//                                         <button
//                                             onClick={() => handleRegister(exam.id, requiresPayment)}
//                                             disabled={exam.remaining_slots <= 0}
//                                             className={`w-full px-4 py-2.5 rounded-xl text-white font-medium transition-colors duration-200 ${
//                                                 exam.remaining_slots <= 0
//                                                     ? 'bg-gray-300 cursor-not-allowed'
//                                                     : requiresPayment
//                                                         ? 'bg-blue-600 hover:bg-blue-700'
//                                                         : 'bg-green-600 hover:bg-green-700'
//                                             }`}
//                                         >
//                                             <i className={`mr-2 ${requiresPayment ? 'fas fa-credit-card' : 'fas fa-edit'}`}></i>
//                                             {requiresPayment ? 'Плати и се запиши' : 'Запиши се'}
//                                         </button>
//                                     </div>
//                                 );
//                             })}
//                         </div>
//                     )}
//                 </main>
//             </div>
//         </div>
//     );
// }
// import { useState, useEffect } from 'react';
// import { useAuth } from '../hooks/useAuth';
// import Header from './Header';
// import Sidebar from './Sidebar';
// import Alert from './Alert';
// import PaymentModal from './PaymentModal';
// import './Exam.css';
//
// export default function Exams() {
//     const { user, token } = useAuth();
//     const [exams, setExams] = useState([]);
//     const [loading, setLoading] = useState(true);
//     const [error, setError] = useState(null);
//     const [success, setSuccess] = useState(null);
//     const [showPaymentModal, setShowPaymentModal] = useState(false);
//     const [selectedExam, setSelectedExam] = useState(null);
//
//     useEffect(() => {
//         fetchExams();
//     }, []);
//
//     const fetchExams = async () => {
//         try {
//             const response = await fetch('http://localhost:8000/api/exams', {
//                 headers: {
//                     'Authorization': `Bearer ${token}`,
//                     'Accept': 'application/json',
//                 }
//             });
//
//             if (!response.ok) {
//                 throw new Error(`Грешка при зареждане на изпитите: ${response.status}`);
//             }
//
//             const data = await response.json();
//             let examsData = [];
//
//             if (Array.isArray(data)) {
//                 examsData = data;
//             } else if (data.data && Array.isArray(data.data)) {
//                 examsData = data.data;
//             } else if (data.exams && Array.isArray(data.exams)) {
//                 examsData = data.exams;
//             } else {
//                 throw new Error('Неочакван формат на данните от сървъра');
//             }
//
//             setExams(examsData);
//         } catch (err) {
//             console.error('Грешка при зареждане на изпити:', err);
//             setError(err.message);
//         } finally {
//             setLoading(false);
//         }
//     };
//
//     const handleRegister = async (exam) => {
//         try {
//             const requiresPayment = exam.exam_type === 'ликвидация' ||
//                 (exam.subject && exam.subject.semester < user.student.semester);
//
//             if (requiresPayment) {
//                 setSelectedExam(exam);
//                 setShowPaymentModal(true);
//             } else {
//                 const response = await fetch(`http://localhost:8000/api/exams/${exam.id}/register`, {
//                     method: 'POST',
//                     headers: {
//                         'Authorization': `Bearer ${token}`,
//                         'Content-Type': 'application/json',
//                     }
//                 });
//
//                 if (!response.ok) {
//                     const errorData = await response.json();
//                     throw new Error(errorData.message || 'Грешка при записване за изпита');
//                 }
//
//                 const result = await response.json();
//                 setSuccess(result.message || 'Успешно се записахте за изпита!');
//                 fetchExams(); // Презареждане на изпитите
//             }
//         } catch (err) {
//             setError(err.message);
//         }
//     };
//
//     const handlePaymentSuccess = () => {
//         setShowPaymentModal(false);
//         setSelectedExam(null);
//         setSuccess('Плащането е успешно и сте записани за изпита!');
//         fetchExams(); // Презареждане на изпитите
//     };
//
//     const handlePaymentError = (error) => {
//         setError(error.message || 'Възникна грешка при плащането');
//         setShowPaymentModal(false);
//         setSelectedExam(null);
//     };
//
//     const closeAlert = () => {
//         setError(null);
//         setSuccess(null);
//     };
//
//     if (loading) {
//         return (
//             <div className="min-h-screen bg-gradient-to-br from-indigo-50 to-blue-50 flex items-center justify-center">
//                 <div className="text-center">
//                     <div className="animate-spin rounded-full h-12 w-12 border-b-2 border-blue-600 mx-auto"></div>
//                     <p className="mt-3 text-gray-600">Зареждане на изпити...</p>
//                 </div>
//             </div>
//         );
//     }
//
//     return (
//         <div className="bg-gradient-to-br from-indigo-50 to-blue-50 min-h-screen overflow-x-hidden">
//             <Header />
//
//             <div className="page-layout flex">
//                 <Sidebar user={user} />
//
//                 <main className="p-4 lg:p-6 flex-1">
//                     <div className="bg-white/90 backdrop-blur-md shadow-sm py-4 mb-6 rounded-xl border border-gray-100">
//                         <div className="flex flex-col md:flex-row justify-between items-start md:items-center px-6 gap-4">
//                             <div>
//                                 <h1 className="text-2xl font-bold text-gray-800">Достъпни изпити</h1>
//                                 <p className="text-sm text-gray-500 mt-1">Преглед и записване за предстоящи изпити</p>
//                             </div>
//                             <a
//                                 href="/my-exams"
//                                 className="inline-flex items-center gap-1 px-4 py-2.5 bg-green-500 text-white rounded-lg shadow hover:bg-green-600 transition-colors"
//                             >
//                                 <i className="fas fa-list-alt"></i>
//                                 Моите изпити
//                             </a>
//                         </div>
//                     </div>
//
//                     {error && <Alert type="error" message={error} onClose={closeAlert} />}
//                     {success && <Alert type="success" message={success} onClose={closeAlert} />}
//
//                     {!exams || exams.length === 0 ? (
//                         <div className="text-center p-8 bg-white border border-gray-100 shadow-sm rounded-xl">
//                             <i className="fas fa-calendar-times text-4xl text-gray-300 mb-4"></i>
//                             <h3 className="text-lg font-medium text-gray-700 mb-2">Няма налични изпити</h3>
//                             <p className="text-gray-500">В момента няма изпити за записване. Моля, проверете по-късно.</p>
//                         </div>
//                     ) : (
//                         <div className="grid gap-6 grid-cols-1 sm:grid-cols-2 xl:grid-cols-3">
//                             {exams.map((exam) => {
//                                 const subjectName = exam.subject ? exam.subject.subject_name : 'Неизвестен предмет';
//                                 const teacherName = exam.teacher && exam.teacher.user ?
//                                     `${exam.teacher.user.first_name} ${exam.teacher.user.last_name}` : 'Неизвестен преподавател';
//                                 const requiresPayment = exam.exam_type === 'ликвидация' ||
//                                     (exam.subject && exam.subject.semester < user.student.semester);
//
//                                 return (
//                                     <div key={exam.id} className="bg-white border border-gray-100 rounded-xl p-4 sm:p-6 hover:shadow-md transition-all hover:border-indigo-100 hover:-translate-y-0.5">
//                                         <div className="flex flex-col sm:flex-row sm:justify-between items-start gap-2 mb-3">
//                                             <h2 className="text-lg font-semibold text-gray-900 leading-tight">
//                                                 {subjectName}
//                                             </h2>
//                                             <div className="flex flex-wrap gap-2">
//                                                 <span className="px-2.5 py-1 rounded-full text-xs font-medium bg-purple-100 text-purple-800">
//                                                     {exam.exam_type}
//                                                 </span>
//                                                 <span className={`px-2.5 py-1 rounded-full text-xs font-medium ${
//                                                     exam.remaining_slots > 0 ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800'
//                                                 }`}>
//                                                     {exam.remaining_slots > 0 ? `${exam.remaining_slots} Свободни места` : 'Няма места'}
//                                                 </span>
//                                             </div>
//                                         </div>
//
//                                         <div className="space-y-3 mb-5">
//                                             <div className="flex items-center gap-2 text-gray-600">
//                                                 <i className="fas fa-chalkboard-teacher w-5 text-gray-400"></i>
//                                                 <span>Преподавател: <span className="font-medium text-gray-800">
//                                                     {teacherName}
//                                                 </span></span>
//                                             </div>
//                                             <div className="flex items-center gap-2 text-gray-600">
//                                                 <i className="fas fa-calendar-alt w-5 text-gray-400"></i>
//                                                 <span>Дата: <span className="font-medium text-gray-800">
//                                                     {new Date(exam.start_time).toLocaleDateString('bg-BG')}
//                                                 </span></span>
//                                             </div>
//                                             <div className="flex items-center gap-2 text-gray-600">
//                                                 <i className="fas fa-clock w-5 text-gray-400"></i>
//                                                 <span>Продължителност: <span className="font-medium text-gray-800">
//                                                     {new Date(exam.start_time).toLocaleTimeString('bg-BG', { hour: '2-digit', minute: '2-digit' })} -
//                                                     {new Date(exam.end_time).toLocaleTimeString('bg-BG', { hour: '2-digit', minute: '2-digit' })}
//                                                 </span></span>
//                                             </div>
//                                             <div className="flex items-center gap-2 text-gray-600">
//                                                 <i className="fas fa-university w-5 text-gray-400"></i>
//                                                 <span>Зала: <span className="font-medium text-gray-800">{exam.hall?.name || 'Неизвестна зала'}</span></span>
//                                             </div>
//                                         </div>
//
//                                         <button
//                                             onClick={() => handleRegister(exam)}
//                                             disabled={exam.remaining_slots <= 0}
//                                             className={`w-full px-4 py-2.5 rounded-xl text-white font-medium transition-colors duration-200 ${
//                                                 exam.remaining_slots <= 0
//                                                     ? 'bg-gray-300 cursor-not-allowed'
//                                                     : requiresPayment
//                                                         ? 'bg-blue-600 hover:bg-blue-700'
//                                                         : 'bg-green-600 hover:bg-green-700'
//                                             }`}
//                                         >
//                                             <i className={`mr-2 ${requiresPayment ? 'fas fa-credit-card' : 'fas fa-edit'}`}></i>
//                                             {requiresPayment ? 'Плати и се запиши' : 'Запиши се'}
//                                         </button>
//                                     </div>
//                                 );
//                             })}
//                         </div>
//                     )}
//
//                     {showPaymentModal && selectedExam && (
//                         <PaymentModal
//                             exam={selectedExam}
//                             onSuccess={handlePaymentSuccess}
//                             onError={handlePaymentError}
//                             onClose={() => {
//                                 setShowPaymentModal(false);
//                                 setSelectedExam(null);
//                             }}
//                         />
//                     )}
//                 </main>
//             </div>
//         </div>
//     );
// }
// Exam.jsx - актуализирана версия
// import { useState, useEffect } from 'react';
// import { useAuth } from '../hooks/useAuth';
// import Header from './Header';
// import Sidebar from './Sidebar';
// import Alert from './Alert';
// import PaymentModal from './PaymentModal';
// import './Exam.css';
//
// export default function Exams() {
//     const { user, token } = useAuth();
//     const [exams, setExams] = useState([]);
//     const [loading, setLoading] = useState(true);
//     const [error, setError] = useState(null);
//     const [success, setSuccess] = useState(null);
//     const [showPaymentModal, setShowPaymentModal] = useState(false);
//     const [selectedExam, setSelectedExam] = useState(null);
//
//     useEffect(() => {
//         fetchExams();
//     }, []);
//
//     const fetchExams = async () => {
//         try {
//             const response = await fetch('http://localhost:8000/api/exams', {
//                 headers: {
//                     'Authorization': `Bearer ${token}`,
//                     'Accept': 'application/json',
//                 }
//             });
//
//             if (!response.ok) {
//                 throw new Error(`Грешка при зареждане на изпитите: ${response.status}`);
//             }
//
//             const data = await response.json();
//             let examsData = [];
//
//             if (Array.isArray(data)) {
//                 examsData = data;
//             } else if (data.data && Array.isArray(data.data)) {
//                 examsData = data.data;
//             } else if (data.exams && Array.isArray(data.exams)) {
//                 examsData = data.exams;
//             } else {
//                 throw new Error('Неочакван формат на данните от сървъра');
//             }
//
//             setExams(examsData);
//         } catch (err) {
//             console.error('Грешка при зареждане на изпити:', err);
//             setError(err.message);
//         } finally {
//             setLoading(false);
//         }
//     };
//
//     const handleRegister = async (exam) => {
//         try {
//             const requiresPayment = exam.exam_type === 'ликвидация' ||
//                 (exam.subject && exam.subject.semester < exam.student.semester);
//
//             if (requiresPayment) {
//                 setSelectedExam(exam);
//                 setShowPaymentModal(true);
//             } else {
//                 const response = await fetch(`http://localhost:8000/api/exams/${exam.id}/register`, {
//                     method: 'POST',
//                     headers: {
//                         'Authorization': `Bearer ${token}`,
//                         'Content-Type': 'application/json',
//                     }
//                 });
//
//                 if (!response.ok) {
//                     const errorData = await response.json();
//                     throw new Error(errorData.message || 'Грешка при записване за изпита');
//                 }
//
//                 const result = await response.json();
//                 setSuccess(result.message || 'Успешно се записахте за изпита!');
//                 fetchExams(); // Презареждане на изпитите
//             }
//         } catch (err) {
//             setError(err.message);
//         }
//     };
//
//     const handlePaymentSuccess = () => {
//         setShowPaymentModal(false);
//         setSelectedExam(null);
//         setSuccess('Плащането е успешно и сте записани за изпита!');
//         fetchExams(); // Презареждане на изпитите
//     };
//
//     const handlePaymentError = (error) => {
//         setError(error.message || 'Възникна грешка при плащането');
//         setShowPaymentModal(false);
//         setSelectedExam(null);
//     };
//
//     const closeAlert = () => {
//         setError(null);
//         setSuccess(null);
//     };
//
//     if (loading) {
//         return (
//             <div className="min-h-screen bg-gradient-to-br from-indigo-50 to-blue-50 flex items-center justify-center">
//                 <div className="text-center">
//                     <div className="animate-spin rounded-full h-12 w-12 border-b-2 border-blue-600 mx-auto"></div>
//                     <p className="mt-3 text-gray-600">Зареждане на изпити...</p>
//                 </div>
//             </div>
//         );
//     }
//
//     return (
//         <div className="bg-gradient-to-br from-indigo-50 to-blue-50 min-h-screen overflow-x-hidden">
//             <Header />
//
//             <div className="page-layout">
//                 <Sidebar user={user} />
//
//                 <main className="p-4 lg:p-6">
//                     <div className="bg-white/90 backdrop-blur-md shadow-sm py-4 mb-6 rounded-xl border border-gray-100">
//                         <div className="flex flex-col md:flex-row justify-between items-start md:items-center px-6 gap-4">
//                             <div>
//                                 <h1 className="text-2xl font-bold text-gray-800">Достъпни изпити</h1>
//                                 <p className="text-sm text-gray-500 mt-1">Преглед и записване за предстоящи изпити</p>
//                             </div>
//
//                         </div>
//                     </div>
//
//                     {error && <Alert type="error" message={error} onClose={closeAlert} />}
//                     {success && <Alert type="success" message={success} onClose={closeAlert} />}
//
//                     {!exams || exams.length === 0 ? (
//                         <div className="text-center p-8 bg-white border border-gray-100 shadow-sm rounded-xl">
//                             <i className="fas fa-calendar-times text-4xl text-gray-300 mb-4"></i>
//                             <h3 className="text-lg font-medium text-gray-700 mb-2">Няма налични изпити</h3>
//                             <p className="text-gray-500">В момента няма изпити за записване. Моля, проверете по-късно.</p>
//                         </div>
//                     ) : (
//                         <div className="grid gap-6 grid-cols-1 sm:grid-cols-2 xl:grid-cols-3">
//                             {exams.map((exam) => {
//                                 const subjectName = exam.subject ? exam.subject.subject_name : 'Неизвестен предмет';
//                                 const teacherName = exam.teacher && exam.teacher.user ?
//                                     `${exam.teacher.user.first_name} ${exam.teacher.user.last_name}` : 'Неизвестен преподавател';
//                                 const requiresPayment = exam.exam_type === 'ликвидация' ||
//                                     (exam.subject && exam.subject.semester < user.student?.semester);
//
//                                 return (
//                                     <div key={exam.id} className="bg-white border border-gray-100 rounded-xl p-4 sm:p-6 hover:shadow-md transition-all hover:border-indigo-100 hover:-translate-y-0.5">
//                                         <div className="flex flex-col sm:flex-row sm:justify-between items-start gap-2 mb-3">
//                                             <h2 className="text-lg font-semibold text-gray-900 leading-tight">
//                                                 {subjectName}
//                                             </h2>
//                                             <div className="flex flex-wrap gap-2">
//                                                 <span className="px-2.5 py-1 rounded-full text-xs font-medium bg-purple-100 text-purple-800">
//                                                     {exam.exam_type}
//                                                 </span>
//                                                 <span className={`px-2.5 py-1 rounded-full text-xs font-medium ${
//                                                     exam.remaining_slots > 0 ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800'
//                                                 }`}>
//                                                     {exam.remaining_slots > 0 ? `${exam.remaining_slots} Свободни места` : 'Няма места'}
//                                                 </span>
//                                             </div>
//                                         </div>
//
//                                         <div className="space-y-3 mb-5">
//                                             <div className="flex items-center gap-2 text-gray-600">
//                                                 <i className="fas fa-chalkboard-teacher w-5 text-gray-400"></i>
//                                                 <span>Преподавател: <span className="font-medium text-gray-800">
//                                                     {teacherName}
//                                                 </span></span>
//                                             </div>
//                                             <div className="flex items-center gap-2 text-gray-600">
//                                                 <i className="fas fa-calendar-alt w-5 text-gray-400"></i>
//                                                 <span>Дата: <span className="font-medium text-gray-800">
//                                                     {new Date(exam.start_time).toLocaleDateString('bg-BG')}
//                                                 </span></span>
//                                             </div>
//                                             <div className="flex items-center gap-2 text-gray-600">
//                                                 <i className="fas fa-clock w-5 text-gray-400"></i>
//                                                 <span>Продължителност: <span className="font-medium text-gray-800">
//                                                     {new Date(exam.start_time).toLocaleTimeString('bg-BG', { hour: '2-digit', minute: '2-digit' })} -
//                                                     {new Date(exam.end_time).toLocaleTimeString('bg-BG', { hour: '2-digit', minute: '2-digit' })}
//                                                 </span></span>
//                                             </div>
//                                             <div className="flex items-center gap-2 text-gray-600">
//                                                 <i className="fas fa-university w-5 text-gray-400"></i>
//                                                 <span>Зала: <span className="font-medium text-gray-800">{exam.hall?.name || 'Неизвестна зала'}</span></span>
//                                             </div>
//                                         </div>
//
//                                         <button
//                                             onClick={() => handleRegister(exam)}
//                                             disabled={exam.remaining_slots <= 0}
//                                             className={`w-full px-4 py-2.5 rounded-xl text-white font-medium transition-colors duration-200 ${
//                                                 exam.remaining_slots <= 0
//                                                     ? 'bg-gray-300 cursor-not-allowed'
//                                                     : requiresPayment
//                                                         ? 'bg-blue-600 hover:bg-blue-700'
//                                                         : 'bg-green-600 hover:bg-green-700'
//                                             }`}
//                                         >
//                                             <i className={`mr-2 ${requiresPayment ? 'fas fa-credit-card' : 'fas fa-edit'}`}></i>
//                                             {requiresPayment ? 'Плати и се запиши' : 'Запиши се'}
//                                         </button>
//                                     </div>
//                                 );
//                             })}
//                         </div>
//                     )}
//
//                     {showPaymentModal && selectedExam && (
//                         <PaymentModal
//                             exam={selectedExam}
//                             onSuccess={handlePaymentSuccess}
//                             onError={handlePaymentError}
//                             onClose={() => {
//                                 setShowPaymentModal(false);
//                                 setSelectedExam(null);
//                             }}
//                         />
//                     )}
//                 </main>
//             </div>
//         </div>
//     );
// }
// Exam.jsx - Main exams page component
// import { useState, useEffect } from 'react';
// import { useAuth } from '../hooks/useAuth';
// import Header from './Header';
// import Sidebar from './Sidebar';
// import Alert from './Alert';
// import PaymentModal from './PaymentModal';
// import './Exam.css';
// import './RightFile.css';
// export default function Exams() {
//     const { user, token } = useAuth();
//     const [exams, setExams] = useState([]);
//     const [loading, setLoading] = useState(true);
//     const [error, setError] = useState(null);
//     const [success, setSuccess] = useState(null);
//     const [showPaymentModal, setShowPaymentModal] = useState(false);
//     const [selectedExam, setSelectedExam] = useState(null);
//
//     useEffect(() => {
//         fetchExams();
//     }, []);
//
//     const fetchExams = async () => {
//         try {
//             const response = await fetch('http://localhost:8000/api/exams', {
//                 headers: {
//                     'Authorization': `Bearer ${token}`,
//                     'Accept': 'application/json',
//                 }
//             });
//
//             if (!response.ok) {
//                 throw new Error(`Грешка при зареждане на изпитите: ${response.status}`);
//             }
//
//             const data = await response.json();
//             let examsData = [];
//
//             if (Array.isArray(data)) {
//                 examsData = data;
//             } else if (data.data && Array.isArray(data.data)) {
//                 examsData = data.data;
//             } else if (data.exams && Array.isArray(data.exams)) {
//                 examsData = data.exams;
//             } else {
//                 throw new Error('Неочакван формат на данните от сървъра');
//             }
//
//             setExams(examsData);
//         } catch (err) {
//             console.error('Грешка при зареждане на изпити:', err);
//             setError(err.message);
//         } finally {
//             setLoading(false);
//         }
//     };
//
//     const handleRegister = async (exam) => {
//         try {
//             const requiresPayment = exam.exam_type === 'ликвидация' ||
//                 (exam.subject && exam.subject.semester < user.student.semester);
//
//             if (requiresPayment) {
//                 setSelectedExam(exam);
//                 setShowPaymentModal(true);
//             } else {
//                 const response = await fetch(`http://localhost:8000/api/exams/${exam.id}/register`, {
//                     method: 'POST',
//                     headers: {
//                         'Authorization': `Bearer ${token}`,
//                         'Content-Type': 'application/json',
//                     }
//                 });
//
//                 if (!response.ok) {
//                     const errorData = await response.json();
//                     throw new Error(errorData.message || 'Грешка при записване за изпита');
//                 }
//
//                 const result = await response.json();
//                 setSuccess(result.message || 'Успешно се записахте за изпита!');
//                 fetchExams(); // Презареждане на изпитите
//             }
//         } catch (err) {
//             setError(err.message);
//         }
//     };
//
//     const handlePaymentSuccess = () => {
//         setShowPaymentModal(false);
//         setSelectedExam(null);
//         setSuccess('Плащането е успешно и сте записани за изпита!');
//         fetchExams(); // Презареждане на изпитите
//     };
//
//     const handlePaymentError = (error) => {
//         setError(error.message || 'Възникна грешка при плащането');
//         setShowPaymentModal(false);
//         setSelectedExam(null);
//     };
//
//     const closeAlert = () => {
//         setError(null);
//         setSuccess(null);
//     };
//
//     if (loading) {
//         return (
//             <div className="min-h-screen bg-gradient-to-br from-indigo-50 to-blue-50 flex items-center justify-center">
//                 <div className="text-center">
//                     <div className="animate-spin rounded-full h-12 w-12 border-b-2 border-blue-600 mx-auto"></div>
//                     <p className="mt-3 text-gray-600">Зареждане на изпити...</p>
//                 </div>
//             </div>
//         );
//     }
//
//     return (
//         <div className="bg-gradient-to-br from-indigo-50 to-blue-50 min-h-screen overflow-x-hidden">
//             <Header />
//
//             <div className="page-layout">
//                 <Sidebar user={user} />
//
//                 <main className="p-4 lg:p-6">
//                     <div className="bg-white/90 backdrop-blur-md shadow-sm py-4 mb-6 rounded-xl border border-gray-100">
//                         <div className="flex flex-col md:flex-row justify-between items-start md:items-center px-6 gap-4">
//                             <div>
//                                 <h1 className="text-2xl font-bold text-gray-800">Достъпни изпити</h1>
//                                 <p className="text-sm text-gray-500 mt-1">Преглед и записване за предстоящи изпити</p>
//                             </div>
//                         </div>
//                     </div>
//
//                     {error && <Alert type="error" message={error} onClose={closeAlert} />}
//                     {success && <Alert type="success" message={success} onClose={closeAlert} />}
//
//                     {!exams || exams.length === 0 ? (
//                         <div className="text-center p-8 bg-white border border-gray-100 shadow-sm rounded-xl">
//                             <i className="fas fa-calendar-times text-4xl text-gray-300 mb-4"></i>
//                             <h3 className="text-lg font-medium text-gray-700 mb-2">Няма налични изпити</h3>
//                             <p className="text-gray-500">В момента няма изпити за записване. Моля, проверете по-късно.</p>
//                         </div>
//                     ) : (
//                         <div className="grid gap-6 grid-cols-1 sm:grid-cols-2 xl:grid-cols-3">
//                             {exams.map((exam) => {
//                                 const subjectName = exam.subject ? exam.subject.subject_name : 'Неизвестен предмет';
//                                 const teacherName = exam.teacher && exam.teacher.user ?
//                                     `${exam.teacher.user.first_name} ${exam.teacher.user.last_name}` : 'Неизвестен преподавател';
//                                 const requiresPayment = exam.exam_type === 'ликвидация' ||
//                                     (exam.subject && exam.subject.semester < user.student.semester);
//
//                                 return (
//                                     <div key={exam.id} className="bg-white border border-gray-100 rounded-xl p-4 sm:p-6 hover:shadow-md transition-all hover:border-indigo-100 hover:-translate-y-0.5">
//                                         <div className="flex flex-col sm:flex-row sm:justify-between items-start gap-2 mb-3">
//                                             <h2 className="text-lg font-semibold text-gray-900 leading-tight">
//                                                 {subjectName}
//                                             </h2>
//                                             <div className="flex flex-wrap gap-2">
//                                                 <span className="px-2.5 py-1 rounded-full text-xs font-medium bg-purple-100 text-purple-800">
//                                                     {exam.exam_type}
//                                                 </span>
//                                                 <span className={`px-2.5 py-1 rounded-full text-xs font-medium ${
//                                                     exam.remaining_slots > 0 ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800'
//                                                 }`}>
//                                                     {exam.remaining_slots > 0 ? `${exam.remaining_slots} Свободни места` : 'Няма места'}
//                                                 </span>
//                                             </div>
//                                         </div>
//
//                                         <div className="space-y-3 mb-5">
//                                             <div className="flex items-center gap-2 text-gray-600">
//                                                 <i className="fas fa-chalkboard-teacher w-5 text-gray-400"></i>
//                                                 <span>Преподавател: <span className="font-medium text-gray-800">
//                                                     {teacherName}
//                                                 </span></span>
//                                             </div>
//                                             <div className="flex items-center gap-2 text-gray-600">
//                                                 <i className="fas fa-calendar-alt w-5 text-gray-400"></i>
//                                                 <span>Дата: <span className="font-medium text-gray-800">
//                                                     {new Date(exam.start_time).toLocaleDateString('bg-BG')}
//                                                 </span></span>
//                                             </div>
//                                             <div className="flex items-center gap-2 text-gray-600">
//                                                 <i className="fas fa-clock w-5 text-gray-400"></i>
//                                                 <span>Продължителност: <span className="font-medium text-gray-800">
//                                                     {new Date(exam.start_time).toLocaleTimeString('bg-BG', { hour: '2-digit', minute: '2-digit' })} -
//                                                     {new Date(exam.end_time).toLocaleTimeString('bg-BG', { hour: '2-digit', minute: '2-digit' })}
//                                                 </span></span>
//                                             </div>
//                                             <div className="flex items-center gap-2 text-gray-600">
//                                                 <i className="fas fa-university w-5 text-gray-400"></i>
//                                                 <span>Зала: <span className="font-medium text-gray-800">{exam.hall?.name || 'Неизвестна зала'}</span></span>
//                                             </div>
//                                         </div>
//
//                                         <button
//                                             onClick={() => handleRegister(exam)}
//                                             disabled={exam.remaining_slots <= 0}
//                                             className={`w-full px-4 py-2.5 rounded-xl text-white font-medium transition-colors duration-200 ${
//                                                 exam.remaining_slots <= 0
//                                                     ? 'bg-gray-300 cursor-not-allowed'
//                                                     : requiresPayment
//                                                         ? 'bg-blue-600 hover:bg-blue-700'
//                                                         : 'bg-green-600 hover:bg-green-700'
//                                             }`}
//                                         >
//                                             <i className={`mr-2 ${requiresPayment ? 'fas fa-credit-card' : 'fas fa-edit'}`}></i>
//                                             {requiresPayment ? 'Плати и се запиши' : 'Запиши се'}
//                                         </button>
//                                     </div>
//                                 );
//                             })}
//                         </div>
//                     )}
//
//                     {showPaymentModal && selectedExam && (
//                         <PaymentModal
//                             exam={selectedExam}
//                             onSuccess={handlePaymentSuccess}
//                             onError={handlePaymentError}
//                             onClose={() => {
//                                 setShowPaymentModal(false);
//                                 setSelectedExam(null);
//                             }}
//                         />
//                     )}
//                 </main>
//             </div>
//         </div>
//     );
// }
// components/Exam.jsx
// import { useState, useEffect } from 'react';
// import { useAuth } from '../hooks/useAuth';
// import Header from './Header';
// import Sidebar from './Sidebar';
// import Alert from './Alert';
// import PaymentModal from './PaymentModal';
// import './Exam.css';
//
// export default function Exams() {
//     const { user, token } = useAuth();
//     const [exams, setExams] = useState([]);
//     const [loading, setLoading] = useState(true);
//     const [error, setError] = useState(null);
//     const [success, setSuccess] = useState(null);
//     const [showPaymentModal, setShowPaymentModal] = useState(false);
//     const [selectedExam, setSelectedExam] = useState(null);
//
//     useEffect(() => {
//         fetchExams();
//     }, []);
//
//     const fetchExams = async () => {
//         try {
//             const response = await fetch('http://localhost:8000/api/exams', {
//                 headers: {
//                     'Authorization': `Bearer ${token}`,
//                     'Accept': 'application/json',
//                 }
//             });
//
//             if (!response.ok) {
//                 throw new Error(`Грешка при зареждане на изпитите: ${response.status}`);
//             }
//
//             const data = await response.json();
//             let examsData = [];
//
//             if (Array.isArray(data)) {
//                 examsData = data;
//             } else if (data.data && Array.isArray(data.data)) {
//                 examsData = data.data;
//             } else if (data.exams && Array.isArray(data.exams)) {
//                 examsData = data.exams;
//             } else {
//                 throw new Error('Неочакван формат на данните от сървъра');
//             }
//
//             setExams(examsData);
//         } catch (err) {
//             console.error('Грешка при зареждане на изпити:', err);
//             setError(err.message);
//         } finally {
//             setLoading(false);
//         }
//     };
//
//     const handleRegister = async (exam) => {
//         try {
//             const requiresPayment = exam.exam_type === 'ликвидация' ||
//                 (exam.subject && exam.subject.semester < user.student.semester);
//
//             if (requiresPayment) {
//                 setSelectedExam(exam);
//                 setShowPaymentModal(true);
//             } else {
//                 const response = await fetch(`http://localhost:8000/api/exams/${exam.id}/register`, {
//                     method: 'POST',
//                     headers: {
//                         'Authorization': `Bearer ${token}`,
//                         'Content-Type': 'application/json',
//                     }
//                 });
//
//                 if (!response.ok) {
//                     const errorData = await response.json();
//                     throw new Error(errorData.message || 'Грешка при записване за изпита');
//                 }
//
//                 const result = await response.json();
//                 setSuccess(result.message || 'Успешно се записахте за изпита!');
//                 fetchExams(); // Презареждане на изпитите
//             }
//         } catch (err) {
//             setError(err.message);
//         }
//     };
//
//     const handlePaymentSuccess = () => {
//         setShowPaymentModal(false);
//         setSelectedExam(null);
//         setSuccess('Плащането е успешно и сте записани за изпита!');
//         fetchExams(); // Презареждане на изпитите
//     };
//
//     const handlePaymentError = (error) => {
//         setError(error.message || 'Възникна грешка при плащането');
//         setShowPaymentModal(false);
//         setSelectedExam(null);
//     };
//
//     const closeAlert = () => {
//         setError(null);
//         setSuccess(null);
//     };
//
//     if (loading) {
//         return (
//             <div className="min-h-screen bg-gradient-to-br from-indigo-50 to-blue-50 flex items-center justify-center">
//                 <div className="text-center">
//                     <div className="animate-spin rounded-full h-12 w-12 border-b-2 border-blue-600 mx-auto"></div>
//                     <p className="mt-3 text-gray-600">Зареждане на изпити...</p>
//                 </div>
//             </div>
//         );
//     }
//
//     return (
//         <div className="bg-gradient-to-br from-indigo-50 to-blue-50 min-h-screen overflow-x-hidden">
//             <Header />
//
//             <div className="page-layout">
//                 <Sidebar user={user} />
//
//                 <main className="p-4 lg:p-6">
//                     <div className="bg-white/90 backdrop-blur-md shadow-sm py-4 mb-6 rounded-xl border border-gray-100">
//                         <div className="flex flex-col md:flex-row justify-between items-start md:items-center px-6 gap-4">
//                             <div>
//                                 <h1 className="text-2xl font-bold text-gray-800">Достъпни изпити</h1>
//                                 <p className="text-sm text-gray-500 mt-1">Преглед и записване за предстоящи изпити</p>
//                             </div>
//                         </div>
//                     </div>
//
//                     {error && <Alert type="error" message={error} onClose={closeAlert} />}
//                     {success && <Alert type="success" message={success} onClose={closeAlert} />}
//
//                     {!exams || exams.length === 0 ? (
//                         <div className="text-center p-8 bg-white border border-gray-100 shadow-sm rounded-xl">
//                             <i className="fas fa-calendar-times text-4xl text-gray-300 mb-4"></i>
//                             <h3 className="text-lg font-medium text-gray-700 mb-2">Няма налични изпити</h3>
//                             <p className="text-gray-500">В момента няма изпити за записване. Моля, проверете по-късно.</p>
//                         </div>
//                     ) : (
//                         <div className="grid gap-6 grid-cols-1 sm:grid-cols-2 xl:grid-cols-3">
//                             {exams.map((exam) => {
//                                 const subjectName = exam.subject ? exam.subject.subject_name : 'Неизвестен предмет';
//                                 const teacherName = exam.teacher && exam.teacher.user ?
//                                     `${exam.teacher.user.first_name} ${exam.teacher.user.last_name}` : 'Неизвестен преподавател';
//                                 const requiresPayment = exam.exam_type === 'ликвидация' ||
//                                     (exam.subject && exam.subject.semester < user.student.semester);
//
//                                 return (
//                                     <div key={exam.id} className="bg-white border border-gray-100 rounded-xl p-4 sm:p-6 hover:shadow-md transition-all hover:border-indigo-100 hover:-translate-y-0.5">
//                                         <div className="flex flex-col sm:flex-row sm:justify-between items-start gap-2 mb-3">
//                                             <h2 className="text-lg font-semibold text-gray-900 leading-tight">
//                                                 {subjectName}
//                                             </h2>
//                                             <div className="flex flex-wrap gap-2">
//                                                 <span className="px-2.5 py-1 rounded-full text-xs font-medium bg-purple-100 text-purple-800">
//                                                     {exam.exam_type}
//                                                 </span>
//                                                 <span className={`px-2.5 py-1 rounded-full text-xs font-medium ${
//                                                     exam.remaining_slots > 0 ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800'
//                                                 }`}>
//                                                     {exam.remaining_slots > 0 ? `${exam.remaining_slots} Свободни места` : 'Няма места'}
//                                                 </span>
//                                             </div>
//                                         </div>
//
//                                         <div className="space-y-3 mb-5">
//                                             <div className="flex items-center gap-2 text-gray-600">
//                                                 <i className="fas fa-chalkboard-teacher w-5 text-gray-400"></i>
//                                                 <span>Преподавател: <span className="font-medium text-gray-800">
//                                                     {teacherName}
//                                                 </span></span>
//                                             </div>
//                                             <div className="flex items-center gap-2 text-gray-600">
//                                                 <i className="fas fa-calendar-alt w-5 text-gray-400"></i>
//                                                 <span>Дата: <span className="font-medium text-gray-800">
//                                                     {new Date(exam.start_time).toLocaleDateString('bg-BG')}
//                                                 </span></span>
//                                             </div>
//                                             <div className="flex items-center gap-2 text-gray-600">
//                                                 <i className="fas fa-clock w-5 text-gray-400"></i>
//                                                 <span>Продължителност: <span className="font-medium text-gray-800">
//                                                     {new Date(exam.start_time).toLocaleTimeString('bg-BG', { hour: '2-digit', minute: '2-digit' })} -
//                                                     {new Date(exam.end_time).toLocaleTimeString('bg-BG', { hour: '2-digit', minute: '2-digit' })}
//                                                 </span></span>
//                                             </div>
//                                             <div className="flex items-center gap-2 text-gray-600">
//                                                 <i className="fas fa-university w-5 text-gray-400"></i>
//                                                 <span>Зала: <span className="font-medium text-gray-800">{exam.hall?.name || 'Неизвестна зала'}</span></span>
//                                             </div>
//                                         </div>
//
//                                         <button
//                                             onClick={() => handleRegister(exam)}
//                                             disabled={exam.remaining_slots <= 0}
//                                             className={`w-full px-4 py-2.5 rounded-xl text-white font-medium transition-colors duration-200 ${
//                                                 exam.remaining_slots <= 0
//                                                     ? 'bg-gray-300 cursor-not-allowed'
//                                                     : requiresPayment
//                                                         ? 'bg-blue-600 hover:bg-blue-700'
//                                                         : 'bg-green-600 hover:bg-green-700'
//                                             }`}
//                                         >
//                                             <i className={`mr-2 ${requiresPayment ? 'fas fa-credit-card' : 'fas fa-edit'}`}></i>
//                                             {requiresPayment ? 'Плати и се запиши' : 'Запиши се'}
//                                         </button>
//                                     </div>
//                                 );
//                             })}
//                         </div>
//                     )}
//
//                     {showPaymentModal && selectedExam && (
//                         <PaymentModal
//                             exam={selectedExam}
//                             onSuccess={handlePaymentSuccess}
//                             onError={handlePaymentError}
//                             onClose={() => {
//                                 setShowPaymentModal(false);
//                                 setSelectedExam(null);
//                             }}
//                         />
//                     )}
//                 </main>
//             </div>
//         </div>
//     );
// }
// import { useState, useEffect } from 'react';
// import { useAuth } from '../hooks/useAuth';
// import Header from './Header';
// import Sidebar from './Sidebar';
// import Alert from './Alert';
// import PaymentModal from './PaymentModal';
// import './Exam.css';
//
// export default function Exams() {
//     const { user, token } = useAuth();
//     const [exams, setExams] = useState([]);
//     const [loading, setLoading] = useState(true);
//     const [error, setError] = useState(null);
//     const [success, setSuccess] = useState(null);
//     const [showPaymentModal, setShowPaymentModal] = useState(false);
//     const [selectedExam, setSelectedExam] = useState(null);
//
//     useEffect(() => {
//         fetchExams();
//     }, []);
//
//     const fetchExams = async () => {
//         try {
//             const response = await fetch('http://localhost:8000/api/exams', {
//                 headers: {
//                     'Authorization': `Bearer ${token}`,
//                     'Accept': 'application/json',
//                 }
//             });
//
//             if (!response.ok) {
//                 throw new Error(`Грешка при зареждане на изпитите: ${response.status}`);
//             }
//
//             const data = await response.json();
//             let examsData = [];
//
//             if (Array.isArray(data)) {
//                 examsData = data;
//             } else if (data.data && Array.isArray(data.data)) {
//                 examsData = data.data;
//             } else if (data.exams && Array.isArray(data.exams)) {
//                 examsData = data.exams;
//             } else {
//                 throw new Error('Неочакван формат на данните от сървъра');
//             }
//
//             setExams(examsData);
//         } catch (err) {
//             console.error('Грешка при зареждане на изпити:', err);
//             setError(err.message);
//         } finally {
//             setLoading(false);
//         }
//     };
//
//     const handleRegister = async (exam) => {
//         try {
//             const requiresPayment = exam.exam_type === 'ликвидация' ||
//                 (exam.subject && exam.subject.semester < user.student.semester);
//
//             if (requiresPayment) {
//                 setSelectedExam(exam);
//                 setShowPaymentModal(true);
//             } else {
//                 const response = await fetch(`http://localhost:8000/api/exams/${exam.id}/register`, {
//                     method: 'POST',
//                     headers: {
//                         'Authorization': `Bearer ${token}`,
//                         'Content-Type': 'application/json',
//                     }
//                 });
//
//                 if (!response.ok) {
//                     const errorData = await response.json();
//                     throw new Error(errorData.message || 'Грешка при записване за изпита');
//                 }
//
//                 const result = await response.json();
//                 setSuccess(result.message || 'Успешно се записахте за изпита!');
//                 fetchExams(); // Презареждане на изпитите
//             }
//         } catch (err) {
//             setError(err.message);
//         }
//     };
//
//     const handlePaymentSuccess = () => {
//         setShowPaymentModal(false);
//         setSelectedExam(null);
//         setSuccess('Плащането е успешно и сте записани за изпита!');
//         fetchExams(); // Презареждане на изпитите
//     };
//
//     const handlePaymentError = (error) => {
//         setError(error.message || 'Възникна грешка при плащането');
//         setShowPaymentModal(false);
//         setSelectedExam(null);
//     };
//
//     const closeAlert = () => {
//         setError(null);
//         setSuccess(null);
//     };
//
//     if (loading) {
//         return (
//             <div className="min-h-screen bg-gradient-to-br from-indigo-50 to-blue-50 flex items-center justify-center">
//                 <div className="text-center">
//                     <div className="animate-spin rounded-full h-12 w-12 border-b-2 border-blue-600 mx-auto"></div>
//                     <p className="mt-3 text-gray-600">Зареждане на изпити...</p>
//                 </div>
//             </div>
//         );
//     }
//
//     return (
//         <div className="bg-gradient-to-br from-indigo-50 to-blue-50 min-h-screen overflow-x-hidden">
//             <Header />
//
//             <div className="page-layout">
//                 <Sidebar user={user} />
//
//                 <main className="p-4 lg:p-6">
//                     <div className="bg-white/90 backdrop-blur-md shadow-sm py-4 mb-6 rounded-xl border border-gray-100">
//                         <div className="flex flex-col md:flex-row justify-between items-start md:items-center px-6 gap-4">
//                             <div>
//                                 <h1 className="text-2xl font-bold text-gray-800">Достъпни изпити</h1>
//                                 <p className="text-sm text-gray-500 mt-1">Преглед и записване за предстоящи изпити</p>
//                             </div>
//                         </div>
//                     </div>
//
//                     {error && <Alert type="error" message={error} onClose={closeAlert} />}
//                     {success && <Alert type="success" message={success} onClose={closeAlert} />}
//
//                     {!exams || exams.length === 0 ? (
//                         <div className="text-center p-8 bg-white border border-gray-100 shadow-sm rounded-xl">
//                             <i className="fas fa-calendar-times text-4xl text-gray-300 mb-4"></i>
//                             <h3 className="text-lg font-medium text-gray-700 mb-2">Няма налични изпити</h3>
//                             <p className="text-gray-500">В момента няма изпити за записване. Моля, проверете по-късно.</p>
//                         </div>
//                     ) : (
//                         <div className="grid gap-6 grid-cols-1 sm:grid-cols-2 xl:grid-cols-3">
//                             {exams.map((exam) => {
//                                 const subjectName = exam.subject ? exam.subject.subject_name : 'Неизвестен предмет';
//                                 const teacherName = exam.teacher && exam.teacher.user ?
//                                     `${exam.teacher.user.first_name} ${exam.teacher.user.last_name}` : 'Неизвестен преподавател';
//                                 const requiresPayment = exam.exam_type === 'ликвидация' ||
//                                     (exam.subject && exam.subject.semester < user.student.semester);
//
//                                 return (
//                                     <div key={exam.id} className="bg-white border border-gray-100 rounded-xl p-4 sm:p-6 hover:shadow-md transition-all hover:border-indigo-100 hover:-translate-y-0.5">
//                                         <div className="flex flex-col sm:flex-row sm:justify-between items-start gap-2 mb-3">
//                                             <h2 className="text-lg font-semibold text-gray-900 leading-tight">
//                                                 {subjectName}
//                                             </h2>
//                                             <div className="flex flex-wrap gap-2">
//                                                 <span className="px-2.5 py-1 rounded-full text-xs font-medium bg-purple-100 text-purple-800">
//                                                     {exam.exam_type}
//                                                 </span>
//                                                 <span className={`px-2.5 py-1 rounded-full text-xs font-medium ${
//                                                     exam.remaining_slots > 0 ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800'
//                                                 }`}>
//                                                     {exam.remaining_slots > 0 ? `${exam.remaining_slots} Свободни места` : 'Няма места'}
//                                                 </span>
//                                             </div>
//                                         </div>
//
//                                         <div className="space-y-3 mb-5">
//                                             <div className="flex items-center gap-2 text-gray-600">
//                                                 <i className="fas fa-chalkboard-teacher w-5 text-gray-400"></i>
//                                                 <span>Преподавател: <span className="font-medium text-gray-800">
//                                                     {teacherName}
//                                                 </span></span>
//                                             </div>
//                                             <div className="flex items-center gap-2 text-gray-600">
//                                                 <i className="fas fa-calendar-alt w-5 text-gray-400"></i>
//                                                 <span>Дата: <span className="font-medium text-gray-800">
//                                                     {new Date(exam.start_time).toLocaleDateString('bg-BG')}
//                                                 </span></span>
//                                             </div>
//                                             <div className="flex items-center gap-2 text-gray-600">
//                                                 <i className="fas fa-clock w-5 text-gray-400"></i>
//                                                 <span>Продължителност: <span className="font-medium text-gray-800">
//                                                     {new Date(exam.start_time).toLocaleTimeString('bg-BG', { hour: '2-digit', minute: '2-digit' })} -
//                                                     {new Date(exam.end_time).toLocaleTimeString('bg-BG', { hour: '2-digit', minute: '2-digit' })}
//                                                 </span></span>
//                                             </div>
//                                             <div className="flex items-center gap-2 text-gray-600">
//                                                 <i className="fas fa-university w-5 text-gray-400"></i>
//                                                 <span>Зала: <span className="font-medium text-gray-800">{exam.hall?.name || 'Неизвестна зала'}</span></span>
//                                             </div>
//                                         </div>
//
//                                         {requiresPayment ? (
//                                             <button
//                                                 onClick={() => setSelectedExam(exam)}
//                                                 disabled={exam.remaining_slots <= 0}
//                                                 className={`w-full px-4 py-2.5 rounded-xl text-white font-medium transition-colors duration-200 ${
//                                                     exam.remaining_slots <= 0
//                                                         ? 'bg-gray-300 cursor-not-allowed'
//                                                         : 'bg-blue-600 hover:bg-blue-700'
//                                                 }`}
//                                             >
//                                                 <i className="fas fa-credit-card mr-2"></i> Плати и се запиши
//                                             </button>
//                                         ) : (
//                                             <button
//                                                 onClick={() => handleRegister(exam)}
//                                                 disabled={exam.remaining_slots <= 0}
//                                                 className={`w-full px-4 py-2.5 rounded-xl text-white font-medium transition-colors duration-200 ${
//                                                     exam.remaining_slots <= 0
//                                                         ? 'bg-gray-300 cursor-not-allowed'
//                                                         : 'bg-green-600 hover:bg-green-700'
//                                                 }`}
//                                             >
//                                                 <i className="fas fa-edit mr-2"></i> Запиши се
//                                             </button>
//                                         )}
//                                     </div>
//                                 );
//                             })}
//                         </div>
//                     )}
//
//                     {selectedExam && (
//                         <PaymentModal
//                             exam={selectedExam}
//                             onSuccess={handlePaymentSuccess}
//                             onError={handlePaymentError}
//                             onClose={() => setSelectedExam(null)}
//                         />
//                     )}
//                 </main>
//             </div>
//         </div>
//     );
// }

// import { useState, useEffect } from 'react';
// import { useAuth } from '../hooks/useAuth';
// import Header from './Header';
// import Sidebar from './Sidebar';
// import Alert from './Alert';
// import PaymentModal from './PaymentModal';
//
//
// export default function Exams() {
//     const { user, token } = useAuth();
//     const [exams, setExams] = useState([]);
//     const [loading, setLoading] = useState(true);
//     const [error, setError] = useState(null);
//     const [success, setSuccess] = useState(null);
//     const [showPaymentModal, setShowPaymentModal] = useState(false);
//     const [selectedExam, setSelectedExam] = useState(null);
//
//     useEffect(() => {
//         fetchExams();
//     }, []);
//
//     const fetchExams = async () => {
//         try {
//             const response = await fetch('http://localhost:8000/api/exams', {
//                 headers: {
//                     'Authorization': `Bearer ${token}`,
//                     'Accept': 'application/json',
//                 }
//             });
//
//             if (!response.ok) {
//                 throw new Error(`Грешка при зареждане на изпитите: ${response.status}`);
//             }
//
//             const data = await response.json();
//             let examsData = [];
//
//             if (Array.isArray(data)) {
//                 examsData = data;
//             } else if (data.data && Array.isArray(data.data)) {
//                 examsData = data.data;
//             } else if (data.exams && Array.isArray(data.exams)) {
//                 examsData = data.exams;
//             } else {
//                 throw new Error('Неочакван формат на данните от сървъра');
//             }
//
//             setExams(examsData);
//         } catch (err) {
//             console.error('Грешка при зареждане на изпити:', err);
//             setError(err.message);
//         } finally {
//             setLoading(false);
//         }
//     };
//
//     const handleRegister = async (exam) => {
//         try {
//             const requiresPayment = exam.exam_type === 'ликвидация' ||
//                 (exam.subject && exam.subject.semester < user.student.semester);
//
//             if (requiresPayment) {
//                 setSelectedExam(exam);
//                 setShowPaymentModal(true);
//             } else {
//                 const response = await fetch(`http://localhost:8000/api/exams/${exam.id}/register`, {
//                     method: 'POST',
//                     headers: {
//                         'Authorization': `Bearer ${token}`,
//                         'Content-Type': 'application/json',
//                     }
//                 });
//
//                 if (!response.ok) {
//                     const errorData = await response.json();
//                     throw new Error(errorData.message || 'Грешка при записване за изпита');
//                 }
//
//                 const result = await response.json();
//                 setSuccess(result.message || 'Успешно се записахте за изпита!');
//                 fetchExams(); // Презареждане на изпитите
//             }
//         } catch (err) {
//             setError(err.message);
//         }
//     };
//
//     const handlePaymentSuccess = () => {
//         setShowPaymentModal(false);
//         setSelectedExam(null);
//         setSuccess('Плащането е успешно и сте записани за изпита!');
//         fetchExams(); // Презареждане на изпитите
//     };
//
//     const handlePaymentError = (error) => {
//         setError(error.message || 'Възникна грешка при плащането');
//         setShowPaymentModal(false);
//         setSelectedExam(null);
//     };
//
//     const closeAlert = () => {
//         setError(null);
//         setSuccess(null);
//     };
//
//     if (loading) {
//         return (
//             <div className="min-h-screen bg-gradient-to-br from-indigo-50 to-blue-50 flex items-center justify-center">
//                 <div className="text-center">
//                     <div className="animate-spin rounded-full h-12 w-12 border-b-2 border-blue-600 mx-auto"></div>
//                     <p className="mt-3 text-gray-600">Зареждане на изпити...</p>
//                 </div>
//             </div>
//         );
//     }
//
//     return (
//         <div className="bg-gradient-to-br from-indigo-50 to-blue-50 min-h-screen overflow-x-hidden">
//             <Header />
//
//             <div className="page-layout">
//                 <Sidebar user={user} />
//
//                 <main className="p-4 lg:p-6">
//                     <div className="bg-white/90 backdrop-blur-md shadow-sm py-4 mb-6 rounded-xl border border-gray-100">
//                         <div className="flex flex-col md:flex-row justify-between items-start md:items-center px-6 gap-4">
//                             <div>
//                                 <h1 className="text-2xl font-bold text-gray-800">Достъпни изпити</h1>
//                                 <p className="text-sm text-gray-500 mt-1">Преглед и записване за предстоящи изпити</p>
//                             </div>
//                             <a
//                                 href="/my-exams"
//                                 className="inline-flex items-center gap-1 px-4 py-2.5 bg-green-500 text-white rounded-lg shadow hover:bg-green-600 transition-colors"
//                             >
//                                 <i className="fas fa-list-alt"></i>
//                                 Моите изпити
//                             </a>
//                         </div>
//                     </div>
//
//                     {error && <Alert type="error" message={error} onClose={closeAlert} />}
//                     {success && <Alert type="success" message={success} onClose={closeAlert} />}
//
//                     {!exams || exams.length === 0 ? (
//                         <div className="text-center p-8 bg-white border border-gray-100 shadow-sm rounded-xl">
//                             <i className="fas fa-calendar-times text-4xl text-gray-300 mb-4"></i>
//                             <h3 className="text-lg font-medium text-gray-700 mb-2">Няма налични изпити</h3>
//                             <p className="text-gray-500">В момента няма изпити за записване. Моля, проверете по-късно.</p>
//                         </div>
//                     ) : (
//                         <div className="grid gap-6 grid-cols-1 sm:grid-cols-2 xl:grid-cols-3">
//                             {exams.map((exam) => {
//                                 const subjectName = exam.subject ? exam.subject.subject_name : 'Неизвестен предмет';
//                                 const teacherName = exam.teacher && exam.teacher.user ?
//                                     `${exam.teacher.user.first_name} ${exam.teacher.user.last_name}` : 'Неизвестен преподавател';
//                                 const requiresPayment = exam.exam_type === 'ликвидация' ||
//                                     (exam.subject && exam.subject.semester < user.student.semester);
//
//                                 return (
//                                     <div key={exam.id} className="bg-white border border-gray-100 rounded-xl p-4 sm:p-6 hover:shadow-md transition-all hover:border-indigo-100 hover:-translate-y-0.5">
//                                         <div className="flex flex-col sm:flex-row sm:justify-between items-start gap-2 mb-3">
//                                             <h2 className="text-lg font-semibold text-gray-900 leading-tight">
//                                                 {subjectName}
//                                             </h2>
//                                             <div className="flex flex-wrap gap-2">
//                                                 <span className="px-2.5 py-1 rounded-full text-xs font-medium bg-purple-100 text-purple-800">
//                                                     {exam.exam_type}
//                                                 </span>
//                                                 <span className={`px-2.5 py-1 rounded-full text-xs font-medium ${
//                                                     exam.remaining_slots > 0 ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800'
//                                                 }`}>
//                                                     {exam.remaining_slots > 0 ? `${exam.remaining_slots} Свободни места` : 'Няма места'}
//                                                 </span>
//                                             </div>
//                                         </div>
//
//                                         <div className="space-y-3 mb-5">
//                                             <div className="flex items-center gap-2 text-gray-600">
//                                                 <i className="fas fa-chalkboard-teacher w-5 text-gray-400"></i>
//                                                 <span>Преподавател: <span className="font-medium text-gray-800">
//                                                     {teacherName}
//                                                 </span></span>
//                                             </div>
//                                             <div className="flex items-center gap-2 text-gray-600">
//                                                 <i className="fas fa-calendar-alt w-5 text-gray-400"></i>
//                                                 <span>Дата: <span className="font-medium text-gray-800">
//                                                     {new Date(exam.start_time).toLocaleDateString('bg-BG')}
//                                                 </span></span>
//                                             </div>
//                                             <div className="flex items-center gap-2 text-gray-600">
//                                                 <i className="fas fa-clock w-5 text-gray-400"></i>
//                                                 <span>Продължителност: <span className="font-medium text-gray-800">
//                                                     {new Date(exam.start_time).toLocaleTimeString('bg-BG', { hour: '2-digit', minute: '2-digit' })} -
//                                                     {new Date(exam.end_time).toLocaleTimeString('bg-BG', { hour: '2-digit', minute: '2-digit' })}
//                                                 </span></span>
//                                             </div>
//                                             <div className="flex items-center gap-2 text-gray-600">
//                                                 <i className="fas fa-university w-5 text-gray-400"></i>
//                                                 <span>Зала: <span className="font-medium text-gray-800">{exam.hall?.name || 'Неизвестна зала'}</span></span>
//                                             </div>
//                                         </div>
//
//                                         <button
//                                             onClick={() => requiresPayment ? setSelectedExam(exam) : handleRegister(exam)}
//                                             disabled={exam.remaining_slots <= 0}
//                                             className={`w-full px-4 py-2.5 rounded-xl text-white font-medium transition-colors duration-200 ${
//                                                 exam.remaining_slots <= 0
//                                                     ? 'bg-gray-300 cursor-not-allowed'
//                                                     : requiresPayment
//                                                         ? 'bg-blue-600 hover:bg-blue-700'
//                                                         : 'bg-green-600 hover:bg-green-700'
//                                             }`}
//                                         >
//                                             <i className={`mr-2 ${requiresPayment ? 'fas fa-credit-card' : 'fas fa-edit'}`}></i>
//                                             {requiresPayment ? 'Плати и се запиши' : 'Запиши се'}
//                                         </button>
//                                     </div>
//                                 );
//                             })}
//                         </div>
//                     )}
//
//                     {selectedExam && (
//                         <PaymentModal
//                             exam={selectedExam}
//                             onSuccess={handlePaymentSuccess}
//                             onError={handlePaymentError}
//                             onClose={() => setSelectedExam(null)}
//                         />
//                     )}
//                 </main>
//             </div>
//         </div>
//     );
// }
// pages/Exams.jsx
// import { useEffect, useState } from 'react';
// import { useAuth } from '../hooks/useAuth';
// import Header from '../components/Header';
// import Sidebar from '../components/Sidebar';
// import Alert from '../components/Alert';
// import PaymentModal from "./PaymentModal.jsx";
// // import PaymentModal from '../components/PaymentModal'; // ако го ползваш
//
// export default function Exams() {
//     const { user, token } = useAuth();
//     const [exams, setExams] = useState([]);
//     const [loading, setLoading] = useState(true);
//     const [error, setError]   = useState(null);
//     const [success, setSuccess] = useState(null);
//     const [showPaymentModal, setShowPaymentModal] = useState(false);
//     const [selectedExam, setSelectedExam] = useState(null);
//
//     useEffect(() => { (async () => {
//         try {
//             const res = await fetch('http://localhost:8000/api/exams', {
//                 headers: { Authorization: `Bearer ${token}`, Accept: 'application/json' }
//             });
//             const data = await res.json();
//             const list = Array.isArray(data) ? data : Array.isArray(data?.data) ? data.data : Array.isArray(data?.exams) ? data.exams : [];
//             setExams(list);
//         } catch (e) { setError(e.message); } finally { setLoading(false); }
//     })(); }, [token]);
//
//     const handleRegister = async (exam) => {
//         try {
//             const requiresPayment = exam.exam_type === 'ликвидация' || (exam.subject && exam.subject.semester < user.student?.semester);
//             if (requiresPayment) {
//                 setSelectedExam(exam);
//                 setShowPaymentModal(true);
//                 return;
//             }
//             const res = await fetch(`http://localhost:8000/api/exams/${exam.id}/register`, {
//                 method: 'POST',
//                 headers: { Authorization: `Bearer ${token}`, 'Content-Type': 'application/json' }
//             });
//             if (!res.ok) throw new Error((await res.json())?.message || 'Грешка при записване за изпита');
//             const r = await res.json();
//             setSuccess(r.message || 'Успешно се записахте за изпита!');
//             // презареди списъка
//             const again = await fetch('http://localhost:8000/api/exams', { headers: { Authorization: `Bearer ${token}` }});
//             setExams(await again.json());
//         } catch (e) { setError(e.message); }
//     };
//
//     const closeAlert = () => { setError(null); setSuccess(null); };
//
//     if (loading) {
//         return (
//             <div className="min-h-screen bg-gradient-to-br from-indigo-50 to-blue-50 flex items-center justify-center">
//                 <div className="text-center">
//                     <div className="animate-spin rounded-full h-12 w-12 border-b-2 border-blue-600 mx-auto"></div>
//                     <p className="mt-3 text-gray-600">Зареждане на изпити...</p>
//                 </div>
//             </div>
//         );
//     }
//
//     return (
//         <div className="bg-gradient-to-br from-indigo-50 to-blue-50 min-h-screen overflow-x-hidden">
//             <Header />
//
//             <div className="page-layout">
//                 <Sidebar user={user} />
//
//                 <main className="p-4 lg:p-6">
//                     {/* Заглавен блок (същите класове като Blade) */}
//                     <div className="bg-white/90 backdrop-blur-md shadow-sm py-4 mb-6 rounded-xl border border-gray-100">
//                         <div className="flex flex-col md:flex-row justify-between items-start md:items-center px-6 gap-4">
//                             <div>
//                                 <h1 className="text-2xl font-bold text-gray-800">Достъпни изпити</h1>
//                                 <p className="text-sm text-gray-500 mt-1">Преглед и записване за предстоящи изпити</p>
//                             </div>
//                         </div>
//                     </div>
//
//                     {error && <Alert type="error"   message={error}   onClose={closeAlert} />}
//                     {success && <Alert type="success" message={success} onClose={closeAlert} />}
//
//                     {/* Cards grid 1:1 */}
//                     {!exams || exams.length === 0 ? (
//                         <div className="text-center p-8 bg-white border border-gray-100 shadow-sm rounded-xl">
//                             <i className="fas fa-calendar-times text-4xl text-gray-300 mb-4"></i>
//                             <h3 className="text-lg font-medium text-gray-700 mb-2">Няма налични изпити</h3>
//                             <p className="text-gray-500">В момента няма изпити за записване. Моля, проверете по-късно.</p>
//                         </div>
//                     ) : (
//                         <div className="grid gap-6 grid-cols-1 sm:grid-cols-2 xl:grid-cols-3">
//                             {exams.map((exam) => {
//                                 const subjectName = exam.subject?.subject_name || 'Неизвестен предмет';
//                                 const teacherName = exam.teacher?.user ? `${exam.teacher.user.first_name} ${exam.teacher.user.last_name}` : 'Неизвестен преподавател';
//                                 const requiresPayment = exam.exam_type === 'ликвидация' || (exam.subject && exam.subject.semester < user.student?.semester);
//
//                                 return (
//                                     <div key={exam.id} className="bg-white border border-gray-100 rounded-xl p-4 sm:p-6 hover:shadow-md transition-all hover:border-indigo-100 hover:-translate-y-0.5">
//                                         <div className="flex flex-col sm:flex-row sm:justify-between items-start gap-2 mb-3">
//                                             <h2 className="text-lg font-semibold text-gray-900 leading-tight">{subjectName}</h2>
//                                             <div className="flex flex-wrap gap-2">
//                                                 <span className="px-2.5 py-1 rounded-full text-xs font-medium bg-purple-100 text-purple-800">{exam.exam_type}</span>
//                                                 <span className={`px-2.5 py-1 rounded-full text-xs font-medium ${exam.remaining_slots > 0 ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800'}`}>
//                           {exam.remaining_slots > 0 ? `${exam.remaining_slots} Свободни места` : 'Няма места'}
//                         </span>
//                                             </div>
//                                         </div>
//
//                                         <div className="space-y-3 mb-5">
//                                             <div className="flex items-center gap-2 text-gray-600">
//                                                 <i className="fas fa-chalkboard-teacher w-5 text-gray-400"></i>
//                                                 <span>Преподавател: <span className="font-medium text-gray-800">{teacherName}</span></span>
//                                             </div>
//                                             <div className="flex items-center gap-2 text-gray-600">
//                                                 <i className="fas fa-calendar-alt w-5 text-gray-400"></i>
//                                                 <span>Дата: <span className="font-medium text-gray-800">{new Date(exam.start_time).toLocaleDateString('bg-BG')}</span></span>
//                                             </div>
//                                             <div className="flex items-center gap-2 text-gray-600">
//                                                 <i className="fas fa-clock w-5 text-gray-400"></i>
//                                                 <span>Продължителност: <span className="font-medium text-gray-800">
//                           {new Date(exam.start_time).toLocaleTimeString('bg-BG', { hour: '2-digit', minute: '2-digit' })} - {new Date(exam.end_time).toLocaleTimeString('bg-BG', { hour: '2-digit', minute: '2-digit' })}
//                         </span></span>
//                                             </div>
//                                             <div className="flex items-center gap-2 text-gray-600">
//                                                 <i className="fas fa-university w-5 text-gray-400"></i>
//                                                 <span>Зала: <span className="font-medium text-gray-800">{exam.hall?.name || 'Неизвестна зала'}</span></span>
//                                             </div>
//                                         </div>
//
//                                         <button
//                                             onClick={() => handleRegister(exam)}
//                                             disabled={exam.remaining_slots <= 0}
//                                             className={`w-full px-4 py-2.5 rounded-xl text-white font-medium transition-colors duration-200 ${
//                                                 exam.remaining_slots <= 0
//                                                     ? 'bg-gray-300 cursor-not-allowed'
//                                                     : requiresPayment
//                                                         ? 'bg-blue-600 hover:bg-blue-700'
//                                                         : 'bg-green-600 hover:bg-green-700'
//                                             }`}
//                                         >
//                                             <i className={`mr-2 ${requiresPayment ? 'fas fa-credit-card' : 'fas fa-edit'}`}></i>
//                                             {requiresPayment ? 'Плати и се запиши' : 'Запиши се'}
//                                         </button>
//                                     </div>
//                                 );
//                             })}
//                         </div>
//                     )}
//
//
//                      {showPaymentModal && selectedExam && (
//             <PaymentModal exam={selectedExam} onSuccess={() => { setShowPaymentModal(false); setSelectedExam(null); setSuccess('Плащането е успешно и сте записани за изпита!'); }} onError={(e)=>{ setShowPaymentModal(false); setSelectedExam(null); setError(e.message || 'Грешка при плащане'); }} onClose={()=>{ setShowPaymentModal(false); setSelectedExam(null); }} />
//           )}
//                 </main>
//             </div>
//         </div>
//     );
// }
import { useEffect, useState } from 'react';
import { useAuth, api } from '../hooks/useAuth';
import Header from '../components/Header';
import Sidebar from '../components/Sidebar';
import Alert from '../components/Alert';
import PaymentModal from "./PaymentModal.jsx";

export default function Exams() {
    const { user } = useAuth();
    const [exams, setExams] = useState([]);
    const [loading, setLoading] = useState(true);
    const [error, setError] = useState(null);
    const [success, setSuccess] = useState(null);
    const [showPaymentModal, setShowPaymentModal] = useState(false);
    const [selectedExam, setSelectedExam] = useState(null);

    useEffect(() => {
        fetchExams();
    }, []);

    const fetchExams = async () => {
        try {
            const response = await api.get('/exams');
            const data = response.data;
            console.log(data)
            let examsData = [];
            if (Array.isArray(data)) {
                examsData = data;
            } else if (data.data && Array.isArray(data.data)) {
                examsData = data.data;
            } else if (data.exams && Array.isArray(data.exams)) {
                examsData = data.exams;
            } else {
                throw new Error('Неочакван формат на данните от сървъра');
            }

            setExams(examsData);
        } catch (err) {
            console.error('Грешка при зареждане на изпити:', err);
            setError(err.response?.data?.message || err.message);
        } finally {
            setLoading(false);
        }
    };

    const handleRegister = async (exam) => {
        try {
            const requiresPayment = exam.exam_type === 'ликвидация' ||
                (exam.subject && exam.subject.semester < user.student?.semester);

            if (requiresPayment) {
                setSelectedExam(exam);
                setShowPaymentModal(true);
                return;
            }

            const response = await api.post(`/exams/${exam.id}/register`);
            setSuccess(response.data.message || 'Успешно се записахте за изпита!');

            // Презареждане на списъка с изпити
            fetchExams();
        } catch (err) {
            setError(err.response?.data?.message || err.message);
        }
    };

    const closeAlert = () => {
        setError(null);
        setSuccess(null);
    };

    if (loading) {
        return (
            <div className="min-h-screen bg-gradient-to-br from-indigo-50 to-blue-50 flex items-center justify-center">
                <div className="text-center">
                    <div className="animate-spin rounded-full h-12 w-12 border-b-2 border-blue-600 mx-auto"></div>
                    <p className="mt-3 text-gray-600">Зареждане на изпити...</p>
                </div>
            </div>
        );
    }

    return (
        <div className="bg-gradient-to-br from-indigo-50 to-blue-50 min-h-screen overflow-x-hidden">
            <Header />

            <div className="page-layout">
                <Sidebar user={user} />

                <main className="p-4 lg:p-6">
                    <div className="bg-white/90 backdrop-blur-md shadow-sm py-4 mb-6 rounded-xl border border-gray-100">
                        <div className="flex flex-col md:flex-row justify-between items-start md:items-center px-6 gap-4">
                            <div>
                                <h1 className="text-2xl font-bold text-gray-800">Достъпни изпити</h1>
                                <p className="text-sm text-gray-500 mt-1">Преглед и записване за предстоящи изпити</p>
                            </div>
                        </div>
                    </div>

                    {error && <Alert type="error" message={error} onClose={closeAlert} />}
                    {success && <Alert type="success" message={success} onClose={closeAlert} />}

                    {!exams || exams.length === 0 ? (
                        <div className="text-center p-8 bg-white border border-gray-100 shadow-sm rounded-xl">
                            <i className="fas fa-calendar-times text-4xl text-gray-300 mb-4"></i>
                            <h3 className="text-lg font-medium text-gray-700 mb-2">Няма налични изпити</h3>
                            <p className="text-gray-500">В момента няма изпити за записване. Моля, проверете по-късно.</p>
                        </div>
                    ) : (
                        <div className="grid gap-6 grid-cols-1 sm:grid-cols-2 xl:grid-cols-3">
                            {exams.map((exam) => {
                                const subjectName = exam.subject?.subject_name || 'Неизвестен предмет';
                                const teacherName = exam.teacher?.user ?
                                    `${exam.teacher.user.first_name} ${exam.teacher.user.last_name}` :
                                    'Неизвестен преподавател';
                                const requiresPayment = exam.exam_type === 'ликвидация' ||
                                    (exam.subject && exam.subject.semester < user.student?.semester);

                                return (
                                    <div key={exam.id} className="bg-white border border-gray-100 rounded-xl p-4 sm:p-6 hover:shadow-md transition-all hover:border-indigo-100 hover:-translate-y-0.5">
                                        <div className="flex flex-col sm:flex-row sm:justify-between items-start gap-2 mb-3">
                                            <h2 className="text-lg font-semibold text-gray-900 leading-tight">{subjectName}</h2>
                                            <div className="flex flex-wrap gap-2">
                                                <span className="px-2.5 py-1 rounded-full text-xs font-medium bg-purple-100 text-purple-800">
                                                    {exam.exam_type}
                                                </span>
                                                <span className={`px-2.5 py-1 rounded-full text-xs font-medium ${
                                                    exam.remaining_slots > 0 ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800'
                                                }`}>
                                                    {exam.remaining_slots > 0 ? `${exam.remaining_slots} Свободни места` : 'Няма места'}
                                                </span>
                                            </div>
                                        </div>

                                        <div className="space-y-3 mb-5">
                                            <div className="flex items-center gap-2 text-gray-600">
                                                <i className="fas fa-chalkboard-teacher w-5 text-gray-400"></i>
                                                <span>Преподавател: <span className="font-medium text-gray-800">{teacherName}</span></span>
                                            </div>
                                            <div className="flex items-center gap-2 text-gray-600">
                                                <i className="fas fa-calendar-alt w-5 text-gray-400"></i>
                                                <span>Дата: <span className="font-medium text-gray-800">
                                                    {new Date(exam.start_time).toLocaleDateString('bg-BG')}
                                                </span></span>
                                            </div>
                                            <div className="flex items-center gap-2 text-gray-600">
                                                <i className="fas fa-clock w-5 text-gray-400"></i>
                                                <span>Продължителност: <span className="font-medium text-gray-800">
                                                    {new Date(exam.start_time).toLocaleTimeString('bg-BG', { hour: '2-digit', minute: '2-digit' })} -
                                                    {new Date(exam.end_time).toLocaleTimeString('bg-BG', { hour: '2-digit', minute: '2-digit' })}
                                                </span></span>
                                            </div>
                                            <div className="flex items-center gap-2 text-gray-600">
                                                <i className="fas fa-university w-5 text-gray-400"></i>
                                                <span>Зала: <span className="font-medium text-gray-800">{exam.hall?.name || 'Неизвестна зала'}</span></span>
                                            </div>
                                        </div>

                                        <button
                                            onClick={() => handleRegister(exam)}
                                            disabled={exam.remaining_slots <= 0}
                                            className={`w-full px-4 py-2.5 rounded-xl text-white font-medium transition-colors duration-200 ${
                                                exam.remaining_slots <= 0
                                                    ? 'bg-gray-300 cursor-not-allowed'
                                                    : requiresPayment
                                                        ? 'bg-blue-600 hover:bg-blue-700'
                                                        : 'bg-green-600 hover:bg-green-700'
                                            }`}
                                        >
                                            <i className={`mr-2 ${requiresPayment ? 'fas fa-credit-card' : 'fas fa-edit'}`}></i>
                                            {requiresPayment ? 'Плати и се запиши' : 'Запиши се'}
                                        </button>
                                    </div>
                                );
                            })}
                        </div>
                    )}

                    {showPaymentModal && selectedExam && (
                        <PaymentModal
                            exam={selectedExam}
                            onSuccess={() => {
                                setShowPaymentModal(false);
                                setSelectedExam(null);
                                setSuccess('Плащането е успешно и сте записани за изпита!');
                                fetchExams();
                            }}
                            onError={(err) => {
                                setShowPaymentModal(false);
                                setSelectedExam(null);
                                setError(err.message || 'Грешка при плащане');
                            }}
                            onClose={() => {
                                setShowPaymentModal(false);
                                setSelectedExam(null);
                            }}
                        />
                    )}
                </main>
            </div>
        </div>
    );
}
