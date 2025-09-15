// import React, { useState, useEffect } from 'react';
// import axios from 'axios';
// import { useAuth } from '../hooks/useAuth';

// const TeacherDashboard = () => {
//     const { user, token } = useAuth();
//     const [exams, setExams] = useState([]);
//     const [subjects, setSubjects] = useState([]);
//     const [halls, setHalls] = useState([]);
//     const [showModal, setShowModal] = useState(false);
//     const [formData, setFormData] = useState({
//         subject_id: '',
//         exam_type: 'редовен',
//         max_students: '',
//         hall_id: '',
//         start_time: '',
//         end_time: ''
//     });
//     const [selectedDate, setSelectedDate] = useState(new Date().toISOString().split('T')[0]);
//     const [selectedSlots, setSelectedSlots] = useState([]);
//     const [bookedSlots, setBookedSlots] = useState([]);
//     const [isEditing, setIsEditing] = useState(false);
//     const [currentExamId, setCurrentExamId] = useState(null);
//     const [loading, setLoading] = useState(true);
//     const [errors, setErrors] = useState({});
//     const [fetchError, setFetchError] = useState(null);
//
//     useEffect(() => {
//         fetchDashboardData();
//     }, []);
// import React, { useState, useEffect, useCallback } from 'react';
// // import axios from 'axios';
// import { useAuth } from '../hooks/useAuth';
// import { api } from '../hooks/useAuth';
// import axios from "axios";
// import Header from './Header';
// import Sidebar from './Sidebar';
//
// const TeacherDashboard = () => {
//     // const { user, token, logout } = useAuth();
//     const { user, token } = useAuth();
//     const [exams, setExams] = useState([]);
//     const [subjects, setSubjects] = useState([]);
//     const [halls, setHalls] = useState([]);
//     const [showModal, setShowModal] = useState(false);
//     const [formData, setFormData] = useState({
//         subject_id: '',
//         exam_type: 'редовен',
//         max_students: '',
//         hall_id: '',
//         start_time: '',
//         end_time: ''
//     });
//     const [selectedDate, setSelectedDate] = useState(new Date().toISOString().split('T')[0]);
//     const [selectedSlots, setSelectedSlots] = useState([]);
//     const [bookedSlots, setBookedSlots] = useState([]);
//     const [isEditing, setIsEditing] = useState(false);
//     const [currentExamId, setCurrentExamId] = useState(null);
//     const [loading, setLoading] = useState(true);
//     const [errors, setErrors] = useState({});
//     const [fetchError, setFetchError] = useState(null);
//
//     // Проверка дали потребителят е учител
//     useEffect(() => {
//         if (user && user.role !== 'teacher') {
//             console.error('Само учители имат достъп до тази страница');
//             setFetchError('Само учители имат достъп до тази страница');
//             setLoading(false);
//             return;
//         }
//     }, [user]);
//
//     const fetchDashboardData = useCallback(async () => {
//         if (!token || !user || user.role !== 'teacher') return;
//
//         try {
//             setLoading(true);
//             // const response = await axios.get('/upcoming_exams', {
//             //     headers: {
//             //         Authorization: `Bearer ${token}`
//             //     }
//             // });
//             const response=await api.get('/upcoming_exams')
//
//             setExams(response.data.exams || []);
//             setSubjects(response.data.subjects || []);
//             setHalls(response.data.halls || []);
//             setFetchError(null);
//         } catch (error) {
//             console.error('Грешка при зареждане на данните:', error);
//
//             if (error.response?.status === 401) {
//                 // Неавторизиран достъп - вероятно изтекъл токен
//                 console.error('Сесията е изтекла, моля влезте отново');
//                 setFetchError('Сесията е изтекла, моля влезте отново');
//                 // logout();
//             } else {
//                 setFetchError('Грешка при зареждане на данните');
//             }
//         } finally {
//             setLoading(false);
//         }
//     }, [token, user,
//         // logout
//     ]);
//
//     useEffect(() => {
//         if (user && user.role === 'teacher') {
//             fetchDashboardData();
//         }
//     }, [user, fetchDashboardData]);
//
//     // Останалите функции остават същите, но с добавена обработка на грешки
//     const fetchBookedSlots = async (hallId, date, excludeExamId = null) => {
//         try {
//             let url = `/booked-slots?date=${date}&hall_id=${hallId}`;
//             if (excludeExamId) {
//                 url += `&exclude_exam_id=${excludeExamId}`;
//             }
//
//             const response = await axios.get(url, {
//                 headers: {
//                     Authorization: `Bearer ${token}`
//                 }
//             });
//
//             setBookedSlots(response.data.bookedSlots);
//         } catch (error) {
//             console.error('Грешка при зареждане на заетите часове:', error);
//             if (error.response?.status === 401) {
//                 // logout();
//             }
//         }
//     };
//
//     // Добавете обработка на грешки за всички останали axios заявки...
//
//     if (!user || user.role !== 'teacher') {
//         return (
//             <div className="container-fluid py-4">
//                 <div className="alert alert-danger">
//                     {fetchError || 'Нямате необходимите права за достъп до тази страница'}
//                 </div>
//             </div>
//         );
//     }
//
//     // const fetchDashboardData = async () => {
//     //     try {
//     //         const response = await axios.get('/upcoming_exams', {
//     //             headers: {
//     //                 Authorization: `Bearer ${token}`
//     //             }
//     //         });
//
//             // setExams(response.data.exams);
//             // setSubjects(response.data.subjects);
//             // setHalls(response.data.halls);
//             // setLoading(false);
//     //         setExams(response.data.exams || []);
//     //         setSubjects(response.data.subjects || []);
//     //         setHalls(response.data.halls || []);
//     //         setLoading(false);
//     //     } catch (error) {
//     //         console.error('Грешка при зареждане на данните:', error);
//     //         setFetchError('Грешка при зареждане на данните'); // Set error message
//     //         setLoading(false);
//     //     }
//     // };
//
//     // const fetchBookedSlots = async (hallId, date, excludeExamId = null) => {
//     //     try {
//     //         let url = `/booked-slots?date=${date}&hall_id=${hallId}`;
//     //         if (excludeExamId) {
//     //             url += `&exclude_exam_id=${excludeExamId}`;
//     //         }
//     //
//     //         const response = await axios.get(url, {
//     //             headers: {
//     //                 Authorization: `Bearer ${token}`
//     //             }
//     //         });
//     //
//     //         setBookedSlots(response.data.bookedSlots);
//     //     } catch (error) {
//     //         console.error('Грешка при зареждане на заетите часове:', error);
//     //     }
//     // };
//
//     const handleDateChange = (e) => {
//         const date = e.target.value;
//         setSelectedDate(date);
//
//         if (formData.hall_id) {
//             fetchBookedSlots(formData.hall_id, date, isEditing ? currentExamId : null);
//         }
//     };
//
//     const handleHallChange = (e) => {
//         const hallId = e.target.value;
//         setFormData({ ...formData, hall_id: hallId });
//
//         if (selectedDate) {
//             fetchBookedSlots(hallId, selectedDate, isEditing ? currentExamId : null);
//         }
//     };
//
//     const handleInputChange = (e) => {
//         const { name, value } = e.target;
//         setFormData({ ...formData, [name]: value });
//     };
//
//     const handleSubmit = async (e) => {
//         e.preventDefault();
//
//         try {
//             if (isEditing) {
//                 await axios.put(`/edit-exams/${currentExamId}`, formData, {
//                     headers: {
//                         Authorization: `Bearer ${token}`
//                     }
//                 });
//             } else {
//                 await axios.post('/examStore', formData, {
//                     headers: {
//                         Authorization: `Bearer ${token}`
//                     }
//                 });
//             }
//
//             setShowModal(false);
//             resetForm();
//             fetchDashboardData(); // Refresh the data
//         } catch (error) {
//             console.error('Грешка при запазване на изпита:', error);
//             if (error.response && error.response.data.errors) {
//                 setErrors(error.response.data.errors);
//             }
//         }
//     };
//
//     const openEditModal = async (examId) => {
//         try {
//             const response = await api.get(`/exam/${examId}/edit-data`, {
//                 headers: {
//                     Authorization: `Bearer ${token}`
//                 }
//             });
//
//             const examData = response.data;
//             console.log(examData)
//             setFormData({
//                 subject_id: examData.subject_id,
//                 exam_type: examData.exam_type,
//                 max_students: examData.max_students,
//                 hall_id: examData.hall_id,
//                 start_time: examData.start_time,
//                 end_time: examData.end_time
//             });
//
//             setSelectedDate(examData.start_time.substring(0, 10));
//             setCurrentExamId(examId);
//             setIsEditing(true);
//             setShowModal(true);
//
//             // Fetch booked slots for the exam's hall and date
//             fetchBookedSlots(examData.hall_id, examData.start_time.substring(0, 10), examId);
//         } catch (error) {
//             console.error('Грешка при зареждане на данните за изпит:', error);
//         }
//     };
//
//     const resetForm = () => {
//         setFormData({
//             subject_id: '',
//             exam_type: 'редовен',
//             max_students: '',
//             hall_id: '',
//             start_time: '',
//             end_time: ''
//         });
//         setSelectedDate(new Date().toISOString().split('T')[0]);
//         setSelectedSlots([]);
//         setBookedSlots([]);
//         setIsEditing(false);
//         setCurrentExamId(null);
//         setErrors({});
//     };
//
//     const openCreateModal = () => {
//         resetForm();
//         setShowModal(true);
//     };
//     if (fetchError) {
//         return (
//             <div className="container-fluid py-4">
//                 <div className="alert alert-danger">
//                     {fetchError}
//                     <button onClick={fetchDashboardData} className="btn btn-sm btn-outline-danger ms-2">
//                         Опитайте отново
//                     </button>
//                 </div>
//             </div>
//         );
//     }
//
//     if (loading) {
//         return (
//             <div className="d-flex justify-content-center align-items-center min-vh-100">
//                 <div className="spinner-border text-primary" role="status">
//                     <span className="visually-hidden">Зареждане...</span>
//                 </div>
//             </div>
//         );
//     }
//
//
//     return (
//         <div className="container-fluid py-4">
//             <div className="row">
//                 <div className="col-12">
//                     <div className="card shadow-sm mb-4">
//
//
//                         <div className="card-header bg-white d-flex justify-content-between align-items-center">
//                             <div>
//                                 <h5 className="mb-0">Управление на изпити</h5>
//                                 <p className="text-muted mb-0">Преглед на предстоящи изпити и възможност за добавяне</p>
//                             </div>
//                             <a href="/conducted-exams" className="btn btn-success">
//                                 <i className="fas fa-folder-open me-2"></i>
//                                 Изминали изпити
//                             </a>
//                         </div>
//                     </div>
//                 </div>
//             </div>
//
//             {!exams || exams.length === 0 ? (
//                 <div className="text-center p-5 bg-white border rounded">
//                     <i className="fas fa-calendar-plus text-muted mb-3" style={{ fontSize: '3rem' }}></i>
//                     <h4 className="text-muted mb-3">Няма създадени изпити</h4>
//                     <button className="btn btn-primary" onClick={openCreateModal}>
//                         Нов изпит
//                     </button>
//                 </div>
//             ) : (
//                 <div className="row">
//                     {exams.map((exam) => (
//                         <div key={exam.id} className="col-md-6 col-lg-4 mb-4">
//                             <div className="card h-100 shadow-sm">
//                                 <div className="card-body">
//                                     <div className="d-flex justify-content-between align-items-start mb-3">
//                                         <h5 className="card-title">{exam.subject?.subject_name}</h5>
//                                         <span className="badge bg-purple">{exam.exam_type}</span>
//                                     </div>
//                                     <p className="text-muted small">{exam.subject?.description}</p>
//
//                                     <div className="mb-3">
//                                         <div className="d-flex align-items-center mb-2">
//                                             <i className="fas fa-calendar-alt text-muted me-2"></i>
//                                             <span>Дата: <strong>{new Date(exam.start_time).toLocaleDateString('bg-BG')}</strong></span>
//                                         </div>
//                                         <div className="d-flex align-items-center mb-2">
//                                             <i className="fas fa-clock text-muted me-2"></i>
//                                             <span>Час: <strong>
//                         {new Date(exam.start_time).toLocaleTimeString('bg-BG', { hour: '2-digit', minute: '2-digit' })} -
//                                                 {new Date(exam.end_time).toLocaleTimeString('bg-BG', { hour: '2-digit', minute: '2-digit' })}
//                       </strong></span>
//                                         </div>
//                                         <div className="d-flex align-items-center mb-2">
//                                             <i className="fas fa-university text-muted me-2"></i>
//                                             <span>Зала: <strong>{exam.hall?.name}</strong></span>
//                                         </div>
//                                         <div className="d-flex align-items-center">
//                                             <i className="fas fa-users text-muted me-2"></i>
//                                             <span className={exam.remainingSlots > 0 ? 'text-success' : 'text-danger'}>
//                         <strong>{exam.remainingSlots}/{exam.max_students} места</strong>
//                       </span>
//                                         </div>
//                                     </div>
//
//                                     <button
//                                         className="btn btn-primary w-100"
//                                         onClick={() => openEditModal(exam.id)}
//                                         disabled={new Date(exam.start_time).getTime() - new Date().getTime() < 48 * 60 * 60 * 1000}
//                                     >
//                                         <i className="fas fa-file-pen me-2"></i>
//                                         Редактирай изпит
//                                     </button>
//                                 </div>
//                             </div>
//                         </div>
//                     ))}
//
//                     <div className="col-md-6 col-lg-4 mb-4 d-flex align-items-center justify-content-center">
//                         <button className="btn btn-primary rounded-circle" style={{ width: '80px', height: '80px' }} onClick={openCreateModal}>
//                             <i className="fas fa-plus"></i>
//                         </button>
//                     </div>
//                 </div>
//             )}
//
//             {/* Модален прозорец за създаване/редактиране на изпит */}
//             {showModal && (
//                 <div className="modal fade show d-block" tabIndex="-1" style={{ backgroundColor: 'rgba(0,0,0,0.5)' }}>
//                     <div className="modal-dialog modal-lg">
//                         <div className="modal-content">
//                             <div className="modal-header">
//                                 <h5 className="modal-title">{isEditing ? 'Редактиране на изпит' : 'Създаване на нов изпит'}</h5>
//                                 <button type="button" className="btn-close" onClick={() => setShowModal(false)}></button>
//                             </div>
//                             <form onSubmit={handleSubmit}>
//                                 <div className="modal-body">
//                                     <div className="row mb-3">
//                                         <div className="col-md-6">
//                                             <label className="form-label">Дисциплина</label>
//                                             <select
//                                                 name="subject_id"
//                                                 className="form-select"
//                                                 value={formData.subject_id}
//                                                 onChange={handleInputChange}
//                                                 required
//                                                 disabled={isEditing}
//                                             >
//                                                 <option value="">Изберете дисциплина</option>
//                                                 {subjects.map(subject => (
//                                                     <option key={subject.id} value={subject.id}>
//                                                         {subject.subject_name} (Сем. {subject.semester})
//                                                     </option>
//                                                 ))}
//                                             </select>
//                                         </div>
//                                         <div className="col-md-6">
//                                             <label className="form-label">Тип изпит</label>
//                                             <select
//                                                 name="exam_type"
//                                                 className="form-select"
//                                                 value={formData.exam_type}
//                                                 onChange={handleInputChange}
//                                                 required
//                                                 disabled={isEditing}
//                                             >
//                                                 <option value="редовен">Редовен</option>
//                                                 <option value="поправителен">Поправителен</option>
//                                                 <option value="ликвидация">Ликвидация</option>
//                                             </select>
//                                         </div>
//                                     </div>
//
//                                     <div className="row mb-3">
//                                         <div className="col-md-6">
//                                             <label className="form-label">Макс. студенти</label>
//                                             <input
//                                                 type="number"
//                                                 name="max_students"
//                                                 className="form-control"
//                                                 value={formData.max_students}
//                                                 onChange={handleInputChange}
//                                                 min="1"
//                                                 required
//                                             />
//                                         </div>
//                                         <div className="col-md-6">
//                                             <label className="form-label">Изпитна зала</label>
//                                             <select
//                                                 name="hall_id"
//                                                 className="form-select"
//                                                 value={formData.hall_id}
//                                                 onChange={handleHallChange}
//                                                 required
//                                             >
//                                                 <option value="">Изберете зала</option>
//                                                 {halls.map(hall => (
//                                                     <option key={hall.id} value={hall.id}>
//                                                         {hall.name} ({hall.capacity} места)
//                                                     </option>
//                                                 ))}
//                                             </select>
//                                         </div>
//                                     </div>
//
//                                     <div className="mb-3">
//                                         <label className="form-label">Дата</label>
//                                         <input
//                                             type="date"
//                                             className="form-control"
//                                             value={selectedDate}
//                                             onChange={handleDateChange}
//                                             required
//                                         />
//                                     </div>
//
//                                     <div className="mb-3">
//                                         <label className="form-label">Изберете свободни часове</label>
//                                         <div className="mt-2">
//                                             <h6 className="text-center">Стая: {formData.hall_id ? halls.find(h => h.id == formData.hall_id)?.name : '---'}</h6>
//                                             <div className="d-flex flex-wrap gap-2">
//                                                 {['07:00', '08:00', '09:00', '10:00', '11:00', '12:00', '13:00', '14:00', '15:00', '16:00', '17:00', '18:00'].map(time => {
//                                                     const isBooked = bookedSlots.some(slot => {
//                                                         const slotTime = new Date(slot.start).toLocaleTimeString('bg-BG', { hour: '2-digit', minute: '2-digit' });
//                                                         return slotTime === time;
//                                                     });
//
//                                                     const isSelected = selectedSlots.includes(time);
//
//                                                     return (
//                                                         <button
//                                                             key={time}
//                                                             type="button"
//                                                             className={`btn ${isSelected ? 'btn-primary' : isBooked ? 'btn-danger' : 'btn-success'}`}
//                                                             style={{ width: '80px' }}
//                                                             disabled={isBooked}
//                                                             onClick={() => {
//                                                                 if (isSelected) {
//                                                                     setSelectedSlots(selectedSlots.filter(t => t !== time));
//                                                                 } else {
//                                                                     setSelectedSlots([...selectedSlots, time]);
//                                                                 }
//                                                             }}
//                                                         >
//                                                             {time}
//                                                         </button>
//                                                     );
//                                                 })}
//                                             </div>
//                                         </div>
//                                     </div>
//
//                                     {Object.keys(errors).length > 0 && (
//                                         <div className="alert alert-danger">
//                                             {Object.values(errors).map((error, index) => (
//                                                 <div key={index}>{error}</div>
//                                             ))}
//                                         </div>
//                                     )}
//                                 </div>
//                                 <div className="modal-footer">
//                                     <button type="button" className="btn btn-secondary" onClick={() => setShowModal(false)}>Отказ</button>
//                                     <button type="submit" className="btn btn-primary">
//                                         {isEditing ? 'Редактирай' : 'Създай'}
//                                     </button>
//                                 </div>
//                             </form>
//                         </div>
//                     </div>
//                 </div>
//             )}
//         </div>
//     );
// };
//
// export default TeacherDashboard;
// import React, { useState, useEffect, useCallback } from 'react';
// import axios from 'axios';
// import { useAuth } from '../hooks/useAuth';
// import { api } from '../hooks/useAuth';
// import Header from './Header';
// import Sidebar from './Sidebar';
//
// const TeacherDashboard = () => {
//     const { user, token } = useAuth();
//     const [exams, setExams] = useState([]);
//     const [subjects, setSubjects] = useState([]);
//     const [halls, setHalls] = useState([]);
//     const [showModal, setShowModal] = useState(false);
//     const [formData, setFormData] = useState({
//         subject_id: '',
//         exam_type: 'редовен',
//         max_students: '',
//         hall_id: '',
//         start_time: '',
//         end_time: ''
//     });
//     const [selectedDate, setSelectedDate] = useState(new Date().toISOString().split('T')[0]);
//     const [selectedSlots, setSelectedSlots] = useState([]);
//     const [bookedSlots, setBookedSlots] = useState([]);
//     const [isEditing, setIsEditing] = useState(false);
//     const [currentExamId, setCurrentExamId] = useState(null);
//     const [loading, setLoading] = useState(true);
//     const [errors, setErrors] = useState({});
//     const [fetchError, setFetchError] = useState(null);
//
//     // Проверка дали потребителят е учител
//     useEffect(() => {
//         if (user && user.role !== 'teacher') {
//             console.error('Само учители имат достъп до тази страница');
//             setFetchError('Само учители имат достъп до тази страница');
//             setLoading(false);
//             return;
//         }
//     }, [user]);
//
//     const fetchDashboardData = useCallback(async () => {
//         if (!token || !user || user.role !== 'teacher') return;
//
//         try {
//             setLoading(true);
//             const response = await api.get('/upcoming_exams');
//             setExams(response.data.exams || []);
//             setSubjects(response.data.subjects || []);
//             setHalls(response.data.halls || []);
//             setFetchError(null);
//         } catch (error) {
//             console.error('Грешка при зареждане на данните:', error);
//
//             if (error.response?.status === 401) {
//                 console.error('Сесията е изтекла, моля влезте отново');
//                 setFetchError('Сесията е изтекла, моля влезте отново');
//             } else {
//                 setFetchError('Грешка при зареждане на данните');
//             }
//         } finally {
//             setLoading(false);
//         }
//     }, [token, user]);
//
//     useEffect(() => {
//         if (user && user.role === 'teacher') {
//             fetchDashboardData();
//         }
//     }, [user, fetchDashboardData]);
//
//     const fetchBookedSlots = async (hallId, date, excludeExamId = null) => {
//         try {
//             let url = `/booked-slots?date=${date}&hall_id=${hallId}`;
//             if (excludeExamId) {
//                 url += `&exclude_exam_id=${excludeExamId}`;
//             }
//
//             const response = await api.get(url)
//             //     , {
//             //     headers: {
//             //         Authorization: `Bearer ${token}`
//             //     }
//             // });
//
//             setBookedSlots(response.data.bookedSlots);
//         } catch (error) {
//             console.error('Грешка при зареждане на заетите часове:', error);
//         }
//     };
//
//     const handleDateChange = (e) => {
//         const date = e.target.value;
//         setSelectedDate(date);
//
//         if (formData.hall_id) {
//             fetchBookedSlots(formData.hall_id, date, isEditing ? currentExamId : null);
//         }
//     };
//
//     const handleHallChange = (e) => {
//         const hallId = e.target.value;
//         setFormData({ ...formData, hall_id: hallId });
//
//         if (selectedDate) {
//             fetchBookedSlots(hallId, selectedDate, isEditing ? currentExamId : null);
//         }
//     };
//
//     const handleInputChange = (e) => {
//         const { name, value } = e.target;
//         setFormData({ ...formData, [name]: value });
//     };
//
//     const handleSubmit = async (e) => {
//         e.preventDefault();
//
//         try {
//             console.log(isEditing)
//             if (isEditing) {
//                 await api.put(`/edit-exams/${currentExamId}`, formData, {
//                     headers: {
//                         Authorization: `Bearer ${token}`
//                     }
//                 });
//             } else {
//                 await axios.post('/examStore', formData, {
//                     headers: {
//                         Authorization: `Bearer ${token}`
//                     }
//                 });
//             }
//
//             setShowModal(false);
//             resetForm();
//             fetchDashboardData();
//         } catch (error) {
//             console.error('Грешка при запазване на изпита:', error);
//             if (error.response && error.response.data.errors) {
//                 setErrors(error.response.data.errors);
//             }
//         }
//     };
//
//     const openEditModal = async (examId) => {
//         try {
//             const response = await api.get(`/exam/${examId}/edit-data`, {
//                 headers: {
//                     Authorization: `Bearer ${token}`
//                 }
//             });
//
//             const examData = response.data;
//             setFormData({
//                 subject_id: examData.subject_id,
//                 exam_type: examData.exam_type,
//                 max_students: examData.max_students,
//                 hall_id: examData.hall_id,
//                 start_time: examData.start_time,
//                 end_time: examData.end_time
//             });
//
//             setSelectedDate(examData.start_time.substring(0, 10));
//             setCurrentExamId(examId);
//             setIsEditing(true);
//             setShowModal(true);
//
//             fetchBookedSlots(examData.hall_id, examData.start_time.substring(0, 10), examId);
//         } catch (error) {
//             console.error('Грешка при зареждане на данните за изпит:', error);
//         }
//     };
//
//     const resetForm = () => {
//         setFormData({
//             subject_id: '',
//             exam_type: 'редовен',
//             max_students: '',
//             hall_id: '',
//             start_time: '',
//             end_time: ''
//         });
//         setSelectedDate(new Date().toISOString().split('T')[0]);
//         setSelectedSlots([]);
//         setBookedSlots([]);
//         setIsEditing(false);
//         setCurrentExamId(null);
//         setErrors({});
//     };
//
//     const openCreateModal = () => {
//         resetForm();
//         setShowModal(true);
//     };
//
//     if (!user || user.role !== 'teacher') {
//         return (
//             <div className="d-flex flex-column" style={{ minHeight: '100vh' }}>
//                 <Header />
//                 <div className="container-fluid py-4">
//                     <div className="alert alert-danger">
//                         {fetchError || 'Нямате необходимите права за достъп до тази страница'}
//                     </div>
//                 </div>
//             </div>
//         );
//     }
//
//     if (fetchError) {
//         return (
//             <div className="d-flex flex-column" style={{ minHeight: '100vh' }}>
//                 <Header />
//                 <div className="container-fluid py-4">
//                     <div className="alert alert-danger">
//                         {fetchError}
//                         <button onClick={fetchDashboardData} className="btn btn-sm btn-outline-danger ms-2">
//                             Опитайте отново
//                         </button>
//                     </div>
//                 </div>
//             </div>
//         );
//     }
//
//     if (loading) {
//         return (
//             <div className="d-flex flex-column" style={{ minHeight: '100vh' }}>
//                 <Header />
//                 <div className="d-flex justify-content-center align-items-center min-vh-100">
//                     <div className="spinner-border text-primary" role="status">
//                         <span className="visually-hidden">Зареждане...</span>
//                     </div>
//                 </div>
//             </div>
//         );
//     }
//
//     return (
//         <div className="d-flex flex-column" style={{ minHeight: '100vh' }}>
//             <Header />
//             <div className="d-flex flex-grow-1">
//                 <Sidebar user={user} />
//                 <div className="flex-grow-1 p-4">
//                     <div className="container-fluid py-4">
//                         <div className="row">
//                             <div className="col-12">
//                                 <div className="card shadow-sm mb-4">
//                                     <div className="card-header bg-white d-flex justify-content-between align-items-center">
//                                         <div>
//                                             <h5 className="mb-0">Управление на изпити</h5>
//                                             <p className="text-muted mb-0">Преглед на предстоящи изпити и възможност за добавяне</p>
//                                         </div>
//                                         <a href="/conducted-exams" className="btn btn-success">
//                                             <i className="fas fa-folder-open me-2"></i>
//                                             Изминали изпити
//                                         </a>
//                                     </div>
//                                 </div>
//                             </div>
//                         </div>
//
//                         {!exams || exams.length === 0 ? (
//                             <div className="text-center p-5 bg-white border rounded">
//                                 <i className="fas fa-calendar-plus text-muted mb-3" style={{ fontSize: '3rem' }}></i>
//                                 <h4 className="text-muted mb-3">Няма създадени изпити</h4>
//                                 <button className="btn btn-primary" onClick={openCreateModal}>
//                                     Нов изпит
//                                 </button>
//                             </div>
//                         ) : (
//                             <div className="row">
//                                 {exams.map((exam) => (
//                                     <div key={exam.id} className="col-md-6 col-lg-4 mb-4">
//                                         <div className="card h-100 shadow-sm">
//                                             <div className="card-body">
//                                                 <div className="d-flex justify-content-between align-items-start mb-3">
//                                                     <h5 className="card-title">{exam.subject?.subject_name}</h5>
//                                                     <span className="badge bg-purple">{exam.exam_type}</span>
//                                                 </div>
//                                                 <p className="text-muted small">{exam.subject?.description}</p>
//
//                                                 <div className="mb-3">
//                                                     <div className="d-flex align-items-center mb-2">
//                                                         <i className="fas fa-calendar-alt text-muted me-2"></i>
//                                                         <span>Дата: <strong>{new Date(exam.start_time).toLocaleDateString('bg-BG')}</strong></span>
//                                                     </div>
//                                                     <div className="d-flex align-items-center mb-2">
//                                                         <i className="fas fa-clock text-muted me-2"></i>
//                                                         <span>Час: <strong>
//                                                             {new Date(exam.start_time).toLocaleTimeString('bg-BG', { hour: '2-digit', minute: '2-digit' })} -
//                                                             {new Date(exam.end_time).toLocaleTimeString('bg-BG', { hour: '2-digit', minute: '2-digit' })}
//                                                         </strong></span>
//                                                     </div>
//                                                     <div className="d-flex align-items-center mb-2">
//                                                         <i className="fas fa-university text-muted me-2"></i>
//                                                         <span>Зала: <strong>{exam.hall?.name}</strong></span>
//                                                     </div>
//                                                     <div className="d-flex align-items-center">
//                                                         <i className="fas fa-users text-muted me-2"></i>
//                                                         <span className={exam.remainingSlots > 0 ? 'text-success' : 'text-danger'}>
//                                                             <strong>{exam.remainingSlots}/{exam.max_students} места</strong>
//                                                         </span>
//                                                     </div>
//                                                 </div>
//
//                                                 <button
//                                                     className="btn btn-primary w-100"
//                                                     onClick={() => openEditModal(exam.id)}
//                                                     disabled={new Date(exam.start_time).getTime() - new Date().getTime() < 48 * 60 * 60 * 1000}
//                                                 >
//                                                     <i className="fas fa-file-pen me-2"></i>
//                                                     Редактирай изпит
//                                                 </button>
//                                             </div>
//                                         </div>
//                                     </div>
//                                 ))}
//
//                                 <div className="col-md-6 col-lg-4 mb-4 d-flex align-items-center justify-content-center">
//                                     <button className="btn btn-primary rounded-circle" style={{ width: '80px', height: '80px' }} onClick={openCreateModal}>
//                                         <i className="fas fa-plus"></i>
//                                     </button>
//                                 </div>
//                             </div>
//                         )}
//
//                         {showModal && (
//                             <div className="modal fade show d-block" tabIndex="-1" style={{ backgroundColor: 'rgba(0,0,0,0.5)' }}>
//                                 <div className="modal-dialog modal-lg">
//                                     <div className="modal-content">
//                                         <div className="modal-header">
//                                             <h5 className="modal-title">{isEditing ? 'Редактиране на изпит' : 'Създаване на нов изпит'}</h5>
//                                             <button type="button" className="btn-close" onClick={() => setShowModal(false)}></button>
//                                         </div>
//                                         <form onSubmit={handleSubmit}>
//                                             <div className="modal-body">
//                                                 <div className="row mb-3">
//                                                     <div className="col-md-6">
//                                                         <label className="form-label">Дисциплина</label>
//                                                         <select
//                                                             name="subject_id"
//                                                             className="form-select"
//                                                             value={formData.subject_id}
//                                                             onChange={handleInputChange}
//                                                             required
//                                                             disabled={isEditing}
//                                                         >
//                                                             <option value="">Изберете дисциплина</option>
//                                                             {subjects.map(subject => (
//                                                                 <option key={subject.id} value={subject.id}>
//                                                                     {subject.subject_name} (Сем. {subject.semester})
//                                                                 </option>
//                                                             ))}
//                                                         </select>
//                                                     </div>
//                                                     <div className="col-md-6">
//                                                         <label className="form-label">Тип изпит</label>
//                                                         <select
//                                                             name="exam_type"
//                                                             className="form-select"
//                                                             value={formData.exam_type}
//                                                             onChange={handleInputChange}
//                                                             required
//                                                             disabled={isEditing}
//                                                         >
//                                                             <option value="редовен">Редовен</option>
//                                                             <option value="поправителен">Поправителен</option>
//                                                             <option value="ликвидация">Ликвидация</option>
//                                                         </select>
//                                                     </div>
//                                                 </div>
//
//                                                 <div className="row mb-3">
//                                                     <div className="col-md-6">
//                                                         <label className="form-label">Макс. студенти</label>
//                                                         <input
//                                                             type="number"
//                                                             name="max_students"
//                                                             className="form-control"
//                                                             value={formData.max_students}
//                                                             onChange={handleInputChange}
//                                                             min="1"
//                                                             required
//                                                         />
//                                                     </div>
//                                                     <div className="col-md-6">
//                                                         <label className="form-label">Изпитна зала</label>
//                                                         <select
//                                                             name="hall_id"
//                                                             className="form-select"
//                                                             value={formData.hall_id}
//                                                             onChange={handleHallChange}
//                                                             required
//                                                         >
//                                                             <option value="">Изберете зала</option>
//                                                             {halls.map(hall => (
//                                                                 <option key={hall.id} value={hall.id}>
//                                                                     {hall.name} ({hall.capacity} места)
//                                                                 </option>
//                                                             ))}
//                                                         </select>
//                                                     </div>
//                                                 </div>
//
//                                                 <div className="mb-3">
//                                                     <label className="form-label">Дата</label>
//                                                     <input
//                                                         type="date"
//                                                         className="form-control"
//                                                         value={selectedDate}
//                                                         onChange={handleDateChange}
//                                                         required
//                                                     />
//                                                 </div>
//
//                                                 <div className="mb-3">
//                                                     <label className="form-label">Изберете свободни часове</label>
//                                                     <div className="mt-2">
//                                                         <h6 className="text-center">Стая: {formData.hall_id ? halls.find(h => h.id == formData.hall_id)?.name : '---'}</h6>
//                                                         <div className="d-flex flex-wrap gap-2">
//                                                             {['07:00', '08:00', '09:00', '10:00', '11:00', '12:00', '13:00', '14:00', '15:00', '16:00', '17:00', '18:00'].map(time => {
//                                                                 console.log(bookedSlots)
//                                                                 const isBooked = bookedSlots.some(slot => {
//                                                                     const slotTime = new Date(slot.start).toLocaleTimeString('bg-BG', { hour: '2-digit', minute: '2-digit' });
//                                                                     return slotTime === time;
//                                                                 });
//                                                                 console.log(isBooked)
//
//                                                                 const isSelected = selectedSlots.includes(time);
//
//                                                                 return (
//                                                                     <button
//                                                                         key={time}
//                                                                         type="button"
//                                                                         className={`btn ${isSelected ? 'btn-primary' : isBooked ? 'btn-danger' : 'btn-success'}`}
//                                                                         style={{ width: '80px' }}
//                                                                         disabled={isBooked}
//                                                                         onClick={() => {
//                                                                             if (isSelected) {
//                                                                                 setSelectedSlots(selectedSlots.filter(t => t !== time));
//                                                                             } else {
//                                                                                 setSelectedSlots([...selectedSlots, time]);
//                                                                             }
//                                                                         }}
//                                                                     >
//                                                                         {time}
//                                                                     </button>
//                                                                 );
//                                                             })}
//                                                         </div>
//                                                     </div>
//                                                 </div>
//
//                                                 {Object.keys(errors).length > 0 && (
//                                                     <div className="alert alert-danger">
//                                                         {Object.values(errors).map((error, index) => (
//                                                             <div key={index}>{error}</div>
//                                                         ))}
//                                                     </div>
//                                                 )}
//                                             </div>
//                                             <div className="modal-footer">
//                                                 <button type="button" className="btn btn-secondary" onClick={() => setShowModal(false)}>Отказ</button>
//                                                 <button type="submit" className="btn btn-primary">
//                                                     {isEditing ? 'Редактирай' : 'Създай'}
//                                                 </button>
//                                             </div>
//                                         </form>
//                                     </div>
//                                 </div>
//                             </div>
//                         )}
//                     </div>
//                 </div>
//             </div>
//         </div>
//     );
// };
//
// export default TeacherDashboard;
// TeacherDashboard.jsx
import React, { useState, useEffect, useCallback } from 'react';
import axios from 'axios';
import { useAuth } from '../hooks/useAuth';
import { api } from '../hooks/useAuth';
import Header from './Header';
import Sidebar from './Sidebar';

const TeacherDashboard = () => {
    const { user, token } = useAuth();
    const [exams, setExams] = useState([]);
    const [subjects, setSubjects] = useState([]);
    const [halls, setHalls] = useState([]);
    const [showModal, setShowModal] = useState(false);
    const [formData, setFormData] = useState({
        subject_id: '',
        exam_type: 'редовен',
        max_students: '',
        hall_id: '',
        start_time: '',
        end_time: ''
    });
    const [selectedDate, setSelectedDate] = useState(new Date().toISOString().split('T')[0]);
    const [selectedSlots, setSelectedSlots] = useState([]);
    const [bookedSlots, setBookedSlots] = useState([]);
    const [isEditing, setIsEditing] = useState(false);
    const [currentExamId, setCurrentExamId] = useState(null);
    const [loading, setLoading] = useState(true);
    const [errors, setErrors] = useState({});
    const [fetchError, setFetchError] = useState(null);
    const [loadingSlots, setLoadingSlots] = useState(false);

    // Check if user is teacher
    useEffect(() => {
        if (user && user.role !== 'teacher') {
            console.error('Само учители имат достъп до тази страница');
            setFetchError('Само учители имат достъп до тази страница');
            setLoading(false);
            return;
        }
    }, [user]);

    const fetchDashboardData = useCallback(async () => {
        if (!token || !user || user.role !== 'teacher') return;

        try {
            setLoading(true);
            const response = await api.get('/upcoming_exams');
            setExams(response.data.exams || []);
            setSubjects(response.data.subjects || []);
            setHalls(response.data.halls || []);
            setFetchError(null);
            const currentTime = new Date();
            console.log(currentTime);
        } catch (error) {
            console.error('Грешка при зареждане на данните:', error);

            if (error.response?.status === 401) {
                console.error('Сесията е изтекла, моля влезте отново');
                setFetchError('Сесията е изтекла, моля влезте отново');
            } else {
                setFetchError('Грешка при зареждане на данните');
            }
        } finally {
            setLoading(false);
        }
    }, [token, user]);

    useEffect(() => {
        if (user && user.role === 'teacher') {
            fetchDashboardData();
        }
    }, [user, fetchDashboardData]);

    const fetchBookedSlots = async (hallId, date, excludeExamId = null) => {
        if (!hallId || !date) return;

        try {
            setLoadingSlots(true);
            let url = `/booked-slots?date=${date}&hall_id=${hallId}`;
            if (excludeExamId) {
                url += `&exclude_exam_id=${excludeExamId}`;
            }

            console.log('Fetching booked slots from:', url);
            const response = await api.get(url);
            console.log('Booked slots response:', response.data);
            setBookedSlots(response.data.bookedSlots || []);
        } catch (error) {
            console.error('Грешка при зареждане на заетите часове:', error);
            setBookedSlots([]);
        } finally {
            setLoadingSlots(false);
        }
    };

    const handleDateChange = (e) => {
        const date = e.target.value;
        setSelectedDate(date);

        if (formData.hall_id) {
            fetchBookedSlots(formData.hall_id, date, isEditing ? currentExamId : null);
        }
    };

    const handleHallChange = (e) => {
        const hallId = e.target.value;
        setFormData({ ...formData, hall_id: hallId });

        if (selectedDate) {
            fetchBookedSlots(hallId, selectedDate, isEditing ? currentExamId : null);
        }
    };

    const handleInputChange = (e) => {
        const { name, value } = e.target;
        setFormData({ ...formData, [name]: value });
    };

    const isTimeSlotBooked = (time) => {
        if (!bookedSlots.length) return false;

        const [hours, minutes] = time.split(':').map(Number);
        const slotStart = new Date(selectedDate);
        slotStart.setHours(hours, minutes, 0, 0);

        const slotEnd = new Date(slotStart);
        slotEnd.setHours(slotStart.getHours() + 1);

        return bookedSlots.some(slot => {
            const bookedStart = new Date(slot.start);
            const bookedEnd = new Date(slot.end);

            // Check for time overlap
            return (
                (slotStart >= bookedStart && slotStart < bookedEnd) ||
                (slotEnd > bookedStart && slotEnd <= bookedEnd) ||
                (slotStart <= bookedStart && slotEnd >= bookedEnd)
            );
        });
    };

    const handleSubmit = async (e) => {
        e.preventDefault();

        try {
            if (isEditing) {
                await axios.put(`/edit-exams/${currentExamId}`, formData, {
                    headers: {
                        Authorization: `Bearer ${token}`
                    }
                });
            } else {
                await axios.post('/examStore', formData, {
                    headers: {
                        Authorization: `Bearer ${token}`
                    }
                });
            }

            setShowModal(false);
            resetForm();
            fetchDashboardData();
        } catch (error) {
            console.error('Грешка при запазване на изпита:', error);
            if (error.response && error.response.data.errors) {
                setErrors(error.response.data.errors);
            }
        }
    };

    const openEditModal = async (examId) => {
        try {
            const response = await api.get(`/exam/${examId}/edit-data`, {
                headers: {
                    Authorization: `Bearer ${token}`
                }
            });

            const examData = response.data;
            setFormData({
                subject_id: examData.subject_id,
                exam_type: examData.exam_type,
                max_students: examData.max_students,
                hall_id: examData.hall_id,
                start_time: examData.start_time,
                end_time: examData.end_time
            });

            setSelectedDate(examData.start_time.substring(0, 10));
            setCurrentExamId(examId);
            setIsEditing(true);
            setShowModal(true);

            fetchBookedSlots(examData.hall_id, examData.start_time.substring(0, 10), examId);
        } catch (error) {
            console.error('Грешка при зареждане на данните за изпит:', error);
        }
    };

    const resetForm = () => {
        setFormData({
            subject_id: '',
            exam_type: 'редовен',
            max_students: '',
            hall_id: '',
            start_time: '',
            end_time: ''
        });
        setSelectedDate(new Date().toISOString().split('T')[0]);
        setSelectedSlots([]);
        setBookedSlots([]);
        setIsEditing(false);
        setCurrentExamId(null);
        setErrors({});
    };

    const openCreateModal = () => {
        resetForm();
        setShowModal(true);
    };

    if (!user || user.role !== 'teacher') {
        return (
            <div className="d-flex flex-column" style={{ minHeight: '100vh' }}>
                <Header />
                <div className="container-fluid py-4">
                    <div className="alert alert-danger">
                        {fetchError || 'Нямате необходимите права за достъп до тази страница'}
                    </div>
                </div>
            </div>
        );
    }

    if (fetchError) {
        return (
            <div className="d-flex flex-column" style={{ minHeight: '100vh' }}>
                <Header />
                <div className="container-fluid py-4">
                    <div className="alert alert-danger">
                        {fetchError}
                        <button onClick={fetchDashboardData} className="btn btn-sm btn-outline-danger ms-2">
                            Опитайте отново
                        </button>
                    </div>
                </div>
            </div>
        );
    }

    if (loading) {
        return (
            <div className="d-flex flex-column" style={{ minHeight: '100vh' }}>
                <Header />
                <div className="d-flex justify-content-center align-items-center min-vh-100">
                    <div className="spinner-border text-primary" role="status">
                        <span className="visually-hidden">Зареждане...</span>
                    </div>
                </div>
            </div>
        );
    }

    return (
        <div className="d-flex flex-column" style={{ minHeight: '100vh' }}>
            <Header />
            <div className="d-flex flex-grow-1">
                <Sidebar user={user} />
                <div className="flex-grow-1 p-4">
                    <div className="container-fluid py-4">
                        <div className="row">
                            <div className="col-12">
                                <div className="card shadow-sm mb-4">
                                    <div className="card-header bg-white d-flex justify-content-between align-items-center">
                                        <div>
                                            <h5 className="mb-0">Управление на изпити</h5>
                                            <p className="text-muted mb-0">Преглед на предстоящи изпити и възможност за добавяне</p>
                                        </div>
                                        <a href="/conducted-exams" className="btn btn-success">
                                            <i className="fas fa-folder-open me-2"></i>
                                            Изминали изпити
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>

                        {!exams || exams.length === 0 ? (
                            <div className="text-center p-5 bg-white border rounded">
                                <i className="fas fa-calendar-plus text-muted mb-3" style={{ fontSize: '3rem' }}></i>
                                <h4 className="text-muted mb-3">Няма създадени изпити</h4>
                                <button className="btn btn-primary" onClick={openCreateModal}>
                                    Нов изпит
                                </button>
                            </div>
                        ) : (
                            <div className="row">
                                {exams.map((exam) => (
                                    <div key={exam.id} className="col-md-6 col-lg-4 mb-4">
                                        <div className="card h-100 shadow-sm">
                                            <div className="card-body">
                                                <div className="d-flex justify-content-between align-items-start mb-3">
                                                    <h5 className="card-title">{exam.subject?.subject_name}</h5>
                                                    <span className="badge bg-purple">{exam.exam_type}</span>
                                                </div>
                                                <p className="text-muted small">{exam.subject?.description}</p>

                                                <div className="mb-3">
                                                    <div className="d-flex align-items-center mb-2">
                                                        <i className="fas fa-calendar-alt text-muted me-2"></i>
                                                        <span>Дата: <strong>{new Date(exam.start_time).toLocaleDateString('bg-BG')}</strong></span>
                                                    </div>
                                                    <div className="d-flex align-items-center mb-2">
                                                        <i className="fas fa-clock text-muted me-2"></i>
                                                        <span>Час: <strong>
                                                            {new Date(exam.start_time).toLocaleTimeString('bg-BG', { hour: '2-digit', minute: '2-digit' })} -
                                                            {new Date(exam.end_time).toLocaleTimeString('bg-BG', { hour: '2-digit', minute: '2-digit' })}
                                                        </strong></span>
                                                    </div>
                                                    <div className="d-flex align-items-center mb-2">
                                                        <i className="fas fa-university text-muted me-2"></i>
                                                        <span>Зала: <strong>{exam.hall?.name}</strong></span>
                                                    </div>
                                                    <div className="d-flex align-items-center">
                                                        <i className="fas fa-users text-muted me-2"></i>
                                                        <span className={exam.remainingSlots > 0 ? 'text-success' : 'text-danger'}>
                                                            <strong>{exam.remainingSlots}/{exam.max_students} места</strong>
                                                        </span>
                                                    </div>
                                                </div>

                                                <button
                                                    className="btn btn-primary w-100"
                                                    onClick={() => openEditModal(exam.id)}
                                                    disabled={new Date(exam.start_time).getTime() - new Date().getTime() < 48 * 60 * 60 * 1000}
                                                >
                                                    <i className="fas fa-file-pen me-2"></i>
                                                    Редактирай изпит
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                ))}

                                <div className="col-md-6 col-lg-4 mb-4 d-flex align-items-center justify-content-center">
                                    <button className="btn btn-primary rounded-circle" style={{ width: '80px', height: '80px' }} onClick={openCreateModal}>
                                        <i className="fas fa-plus"></i>
                                    </button>
                                </div>
                            </div>
                        )}

                        {showModal && (
                            <div className="modal fade show d-block" tabIndex="-1" style={{ backgroundColor: 'rgba(0,0,0,0.5)' }}>
                                <div className="modal-dialog modal-lg">
                                    <div className="modal-content">
                                        <div className="modal-header">
                                            <h5 className="modal-title">{isEditing ? 'Редактиране на изпит' : 'Създаване на нов изпит'}</h5>
                                            <button type="button" className="btn-close" onClick={() => setShowModal(false)}></button>
                                        </div>
                                        <form onSubmit={handleSubmit}>
                                            <div className="modal-body">
                                                <div className="row mb-3">
                                                    <div className="col-md-6">
                                                        <label className="form-label">Дисциплина</label>
                                                        <select
                                                            name="subject_id"
                                                            className="form-select"
                                                            value={formData.subject_id}
                                                            onChange={handleInputChange}
                                                            required
                                                            disabled={isEditing}
                                                        >
                                                            <option value="">Изберете дисциплина</option>
                                                            {subjects.map(subject => (
                                                                <option key={subject.id} value={subject.id}>
                                                                    {subject.subject_name} (Сем. {subject.semester})
                                                                </option>
                                                            ))}
                                                        </select>
                                                    </div>
                                                    <div className="col-md-6">
                                                        <label className="form-label">Тип изпит</label>
                                                        <select
                                                            name="exam_type"
                                                            className="form-select"
                                                            value={formData.exam_type}
                                                            onChange={handleInputChange}
                                                            required
                                                            disabled={isEditing}
                                                        >
                                                            <option value="редовен">Редовен</option>
                                                            <option value="поправителен">Поправителен</option>
                                                            <option value="ликвидация">Ликвидация</option>
                                                        </select>
                                                    </div>
                                                </div>

                                                <div className="row mb-3">
                                                    <div className="col-md-6">
                                                        <label className="form-label">Макс. студенти</label>
                                                        <input
                                                            type="number"
                                                            name="max_students"
                                                            className="form-control"
                                                            value={formData.max_students}
                                                            onChange={handleInputChange}
                                                            min="1"
                                                            required
                                                        />
                                                    </div>
                                                    <div className="col-md-6">
                                                        <label className="form-label">Изпитна зала</label>
                                                        <select
                                                            name="hall_id"
                                                            className="form-select"
                                                            value={formData.hall_id}
                                                            onChange={handleHallChange}
                                                            required
                                                        >
                                                            <option value="">Изберете зала</option>
                                                            {halls.map(hall => (
                                                                <option key={hall.id} value={hall.id}>
                                                                    {hall.name} ({hall.capacity} места)
                                                                </option>
                                                            ))}
                                                        </select>
                                                    </div>
                                                </div>

                                                <div className="mb-3">
                                                    <label className="form-label">Дата</label>
                                                    <input
                                                        type="date"
                                                        className="form-control"
                                                        value={selectedDate}
                                                        onChange={handleDateChange}
                                                        required
                                                    />
                                                </div>

                                                <div className="mb-3">
                                                    <label className="form-label">Изберете свободни часове</label>
                                                    <div className="mt-2">
                                                        <h6 className="text-center">Стая: {formData.hall_id ? halls.find(h => h.id == formData.hall_id)?.name : '---'}</h6>
                                                        {loadingSlots ? (
                                                            <div className="text-center">
                                                                <div className="spinner-border text-primary" role="status">
                                                                    <span className="visually-hidden">Зареждане...</span>
                                                                </div>
                                                            </div>
                                                        ) : (
                                                            <div className="d-flex flex-wrap gap-2">
                                                                {['07:00', '08:00', '09:00', '10:00', '11:00', '12:00', '13:00', '14:00', '15:00', '16:00', '17:00', '18:00'].map(time => {
                                                                    const isBooked = isTimeSlotBooked(time);
                                                                    const isSelected = selectedSlots.includes(time);

                                                                    return (
                                                                        <button
                                                                            key={time}
                                                                            type="button"
                                                                            className={`btn ${isSelected ? 'btn-primary' : isBooked ? 'btn-danger' : 'btn-success'}`}
                                                                            style={{ width: '80px' }}
                                                                            disabled={isBooked}
                                                                            onClick={() => {
                                                                                if (isSelected) {
                                                                                    setSelectedSlots(selectedSlots.filter(t => t !== time));
                                                                                } else {
                                                                                    setSelectedSlots([...selectedSlots, time]);
                                                                                }
                                                                            }}
                                                                        >
                                                                            {time}
                                                                        </button>
                                                                    );
                                                                })}
                                                            </div>
                                                        )}
                                                    </div>
                                                </div>

                                                {Object.keys(errors).length > 0 && (
                                                    <div className="alert alert-danger">
                                                        {Object.values(errors).map((error, index) => (
                                                            <div key={index}>{error}</div>
                                                        ))}
                                                    </div>
                                                )}
                                            </div>
                                            <div className="modal-footer">
                                                <button type="button" className="btn btn-secondary" onClick={() => setShowModal(false)}>Отказ</button>
                                                <button type="submit" className="btn btn-primary">
                                                    {isEditing ? 'Редактирай' : 'Създай'}
                                                </button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        )}
                    </div>
                </div>
            </div>
        </div>
    );
};

export default TeacherDashboard;
