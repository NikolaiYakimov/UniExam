
// // export default TeacherDashboard;
// // import React, { useState, useEffect, useCallback } from 'react';
// // import axios from 'axios';
// // import { useAuth } from '../hooks/useAuth';
// // import { api } from '../hooks/useAuth';
// // import Header from './Header';
// // import Sidebar from './Sidebar';
// // import './Exam.css'
// //
// // const TeacherDashboard = () => {
// //     const { user, token } = useAuth();
// //     const [exams, setExams] = useState([]);
// //     const [subjects, setSubjects] = useState([]);
// //     const [halls, setHalls] = useState([]);
// //     const [showModal, setShowModal] = useState(false);
// //     const [formData, setFormData] = useState({
// //         subject_id: '',
// //         exam_type: 'редовен',
// //         max_students: '',
// //         hall_id: '',
// //         start_time: '',
// //         end_time: ''
// //     });
// //     const [selectedDate, setSelectedDate] = useState(new Date().toISOString().split('T')[0]);
// //     const [selectedSlots, setSelectedSlots] = useState([]);
// //     const [bookedSlots, setBookedSlots] = useState([]);
// //     const [isEditing, setIsEditing] = useState(false);
// //     const [currentExamId, setCurrentExamId] = useState(null);
// //     const [loading, setLoading] = useState(true);
// //     const [errors, setErrors] = useState({});
// //     const [fetchError, setFetchError] = useState(null);
// //     const [loadingSlots, setLoadingSlots] = useState(false);
// //
// //     // Check if user is teacher
// //     useEffect(() => {
// //         if (user && user.role !== 'teacher') {
// //             console.error('Само учители имат достъп до тази страница');
// //             setFetchError('Само учители имат достъп до тази страница');
// //             setLoading(false);
// //             return;
// //         }
// //     }, [user]);
// //
// //     const fetchDashboardData = useCallback(async () => {
// //         if (!token || !user || user.role !== 'teacher') return;
// //
// //         try {
// //             setLoading(true);
// //             const response = await api.get('/upcoming_exams');
// //             setExams(response.data.exams || []);
// //             setSubjects(response.data.subjects || []);
// //             setHalls(response.data.halls || []);
// //             setFetchError(null);
// //         } catch (error) {
// //             console.error('Грешка при зареждане на данните:', error);
// //
// //             if (error.response?.status === 401) {
// //                 console.error('Сесията е изтекла, моля влезте отново');
// //                 setFetchError('Сесията е изтекла, моля влезте отново');
// //             } else {
// //                 setFetchError('Грешка при зареждане на данните');
// //             }
// //         } finally {
// //             setLoading(false);
// //         }
// //     }, [token, user]);
// //
// //     useEffect(() => {
// //         if (user && user.role === 'teacher') {
// //             fetchDashboardData();
// //         }
// //     }, [user, fetchDashboardData]);
// //
// //     const fetchBookedSlots = async (hallId, date, excludeExamId = null) => {
// //         if (!hallId || !date) return;
// //
// //         try {
// //             setLoadingSlots(true);
// //             let url = `/booked-slots?date=${date}&hall_id=${hallId}`;
// //             if (excludeExamId) {
// //                 url += `&exclude_exam_id=${excludeExamId}`;
// //             }
// //
// //             const response = await api.get(url);
// //             setBookedSlots(response.data.bookedSlots || []);
// //         } catch (error) {
// //             console.error('Грешка при зареждане на заетите часове:', error);
// //             setBookedSlots([]);
// //         } finally {
// //             setLoadingSlots(false);
// //         }
// //     };
// //
// //     const handleDateChange = (e) => {
// //         const date = e.target.value;
// //         setSelectedDate(date);
// //         setSelectedSlots([]); // Reset selected slots when date changes
// //
// //         if (formData.hall_id) {
// //             fetchBookedSlots(formData.hall_id, date, isEditing ? currentExamId : null);
// //         }
// //     };
// //
// //     const handleHallChange = (e) => {
// //         const hallId = e.target.value;
// //         setFormData({ ...formData, hall_id: hallId });
// //         setSelectedSlots([]); // Reset selected slots when hall changes
// //
// //         if (selectedDate) {
// //             fetchBookedSlots(hallId, selectedDate, isEditing ? currentExamId : null);
// //         }
// //     };
// //
// //     const handleInputChange = (e) => {
// //         const { name, value } = e.target;
// //         setFormData({ ...formData, [name]: value });
// //     };
// //
// //     const isTimeSlotBooked = (time) => {
// //         if (!bookedSlots.length) return false;
// //
// //         const [hours, minutes] = time.split(':').map(Number);
// //         const slotStart = new Date(selectedDate);
// //         slotStart.setHours(hours, minutes, 0, 0);
// //
// //         const slotEnd = new Date(slotStart);
// //         slotEnd.setHours(slotStart.getHours() + 1);
// //
// //         return bookedSlots.some(slot => {
// //             const bookedStart = new Date(slot.start);
// //             const bookedEnd = new Date(slot.end);
// //
// //             // Check for time overlap
// //             return (
// //                 (slotStart >= bookedStart && slotStart < bookedEnd) ||
// //                 (slotEnd > bookedStart && slotEnd <= bookedEnd) ||
// //                 (slotStart <= bookedStart && slotEnd >= bookedEnd)
// //             );
// //         });
// //     };
// //
// //     // Check if time slots are consecutive
// //     const areSlotsConsecutive = (slots) => {
// //         if (slots.length <= 1) return true;
// //
// //         const sortedSlots = [...slots].sort();
// //         for (let i = 1; i < sortedSlots.length; i++) {
// //             const prevTime = parseInt(sortedSlots[i-1].split(':')[0]);
// //             const currentTime = parseInt(sortedSlots[i].split(':')[0]);
// //             if (currentTime !== prevTime + 1) return false;
// //         }
// //         return true;
// //     };
// //
// //     const handleTimeSlotClick = (time) => {
// //         if (isTimeSlotBooked(time)) return;
// //
// //         setSelectedSlots(prev => {
// //             if (prev.includes(time)) {
// //                 return prev.filter(t => t !== time);
// //             } else {
// //                 const newSlots = [...prev, time].sort();
// //                 if (areSlotsConsecutive(newSlots)) {
// //                     return newSlots;
// //                 } else {
// //                     // If not consecutive, replace selection with new time
// //                     return [time];
// //                 }
// //             }
// //         });
// //     };
// //
// //     const handleSubmit = async (e) => {
// //         e.preventDefault();
// //
// //         if (selectedSlots.length === 0) {
// //             setErrors({ general: 'Моля, изберете поне един времеви слот.' });
// //             return;
// //         }
// //
// //         const sortedSlots = selectedSlots.sort();
// //         const startTime = `${selectedDate}T${sortedSlots[0]}:00`;
// //         const endTime = `${selectedDate}T${sortedSlots[sortedSlots.length - 1]}:00`;
// //
// //         // Add one hour to the end time to account for exam duration
// //         const endTimeDate = new Date(endTime);
// //         endTimeDate.setHours(endTimeDate.getHours() + 1);
// //         const formattedEndTime = endTimeDate.toISOString().slice(0, 16);
// //
// //         const submitData = {
// //             ...formData,
// //             start_time: startTime,
// //             end_time: formattedEndTime
// //         };
// //
// //         try {
// //             if (isEditing) {
// //                 await api.put(`edit-exams/${currentExamId}`, submitData, {
// //                     headers: {
// //                         Authorization: `Bearer ${token}`
// //                     }
// //                 });
// //             } else {
// //                 await axios.post('/examStore', submitData, {
// //                     headers: {
// //                         Authorization: `Bearer ${token}`
// //                     }
// //                 });
// //             }
// //
// //             setShowModal(false);
// //             resetForm();
// //             fetchDashboardData();
// //         } catch (error) {
// //             console.error('Грешка при запазване на изпита:', error);
// //             if (error.response && error.response.data.errors) {
// //                 setErrors(error.response.data.errors);
// //             }
// //         }
// //     };
// //
// //     const openEditModal = async (examId) => {
// //         try {
// //             const response = await api.get(`/exam/${examId}/edit-data`, {
// //                 headers: {
// //                     Authorization: `Bearer ${token}`
// //                 }
// //             });
// //
// //             const examData = response.data;
// //             setFormData({
// //                 subject_id: examData.subject_id,
// //                 exam_type: examData.exam_type,
// //                 max_students: examData.max_students,
// //                 hall_id: examData.hall_id,
// //                 start_time: examData.start_time,
// //                 end_time: examData.end_time
// //             });
// //
// //             setSelectedDate(examData.start_time.substring(0, 10));
// //             setCurrentExamId(examId);
// //             setIsEditing(true);
// //             setShowModal(true);
// //
// //             fetchBookedSlots(examData.hall_id, examData.start_time.substring(0, 10), examId);
// //         } catch (error) {
// //             console.error('Грешка при зареждане на данните за изпит:', error);
// //         }
// //     };
// //
// //     const resetForm = () => {
// //         setFormData({
// //             subject_id: '',
// //             exam_type: 'редовен',
// //             max_students: '',
// //             hall_id: '',
// //             start_time: '',
// //             end_time: ''
// //         });
// //         setSelectedDate(new Date().toISOString().split('T')[0]);
// //         setSelectedSlots([]);
// //         setBookedSlots([]);
// //         setIsEditing(false);
// //         setCurrentExamId(null);
// //         setErrors({});
// //     };
// //
// //     const openCreateModal = () => {
// //         resetForm();
// //         setShowModal(true);
// //     };
// //
// //     const handleModalClose = () => {
// //         setShowModal(false);
// //         resetForm();
// //     };
// //
// //     if (!user || user.role !== 'teacher') {
// //         return (
// //             <div className="d-flex flex-column" style={{ minHeight: '100vh' }}>
// //                 <Header />
// //                 <div className="container-fluid py-4">
// //                     <div className="alert alert-danger">
// //                         {fetchError || 'Нямате необходимите права за достъп до тази страница'}
// //                     </div>
// //                 </div>
// //             </div>
// //         );
// //     }
// //
// //     if (fetchError) {
// //         return (
// //             <div className="d-flex flex-column" style={{ minHeight: '100vh' }}>
// //                 <Header />
// //                 <div className="container-fluid py-4">
// //                     <div className="alert alert-danger">
// //                         {fetchError}
// //                         <button onClick={fetchDashboardData} className="btn btn-sm btn-outline-danger ms-2">
// //                             Опитайте отново
// //                         </button>
// //                     </div>
// //                 </div>
// //             </div>
// //         );
// //     }
// //
// //     if (loading) {
// //         return (
// //             <div className="d-flex flex-column" style={{ minHeight: '100vh' }}>
// //                 <Header />
// //                 <div className="d-flex justify-content-center align-items-center min-vh-100">
// //                     <div className="spinner-border text-primary" role="status">
// //                         <span className="visually-hidden">Зареждане...</span>
// //                     </div>
// //                 </div>
// //             </div>
// //         );
// //     }
// //
// //     return (
// //         <div className="d-flex flex-column" style={{ minHeight: '100vh' }}>
// //             <Header />
// //             <div className="d-flex flex-grow-1">
// //                 <Sidebar user={user} />
// //                 <div className="flex-grow-1 p-4">
// //                     <div className="container-fluid py-4">
// //                         <div className="row">
// //                             <div className="col-12">
// //                                 <div className="card shadow-sm mb-4">
// //                                     <div className="card-header bg-white d-flex justify-content-between align-items-center">
// //                                         <div>
// //                                             <h5 className="mb-0">Управление на изпити</h5>
// //                                             <p className="text-muted mb-0">Преглед на предстоящи изпити и възможност за добавяне</p>
// //                                         </div>
// //                                         <a href="/conducted-exams" className="btn btn-success">
// //                                             <i className="fas fa-folder-open me-2"></i>
// //                                             Изминали изпити
// //                                         </a>
// //                                     </div>
// //                                 </div>
// //                             </div>
// //                         </div>
// //
// //                         {!exams || exams.length === 0 ? (
// //                             <div className="text-center p-5 bg-white border rounded">
// //                                 <i className="fas fa-calendar-plus text-muted mb-3" style={{ fontSize: '3rem' }}></i>
// //                                 <h4 className="text-muted mb-3">Няма създадени изпити</h4>
// //                                 <button className="btn btn-primary" onClick={openCreateModal}>
// //                                     Нов изпит
// //                                 </button>
// //                             </div>
// //                         ) : (
// //                             <div className="row">
// //                                 {exams.map((exam) => (
// //                                     <div key={exam.id} className="col-md-6 col-lg-4 mb-4">
// //                                         <div className="card h-100 shadow-sm">
// //                                             <div className="card-body">
// //                                                 <div className="d-flex justify-content-between align-items-start mb-3">
// //                                                     <h5 className="card-title">{exam.subject?.subject_name}</h5>
// //                                                     <span className="badge bg-purple">{exam.exam_type}</span>
// //                                                 </div>
// //                                                 <p className="text-muted small">{exam.subject?.description}</p>
// //
// //                                                 <div className="mb-3">
// //                                                     <div className="d-flex align-items-center mb-2">
// //                                                         <i className="fas fa-calendar-alt text-muted me-2"></i>
// //                                                         <span>Дата: <strong>{new Date(exam.start_time).toLocaleDateString('bg-BG')}</strong></span>
// //                                                     </div>
// //                                                     <div className="d-flex align-items-center mb-2">
// //                                                         <i className="fas fa-clock text-muted me-2"></i>
// //                                                         <span>Час: <strong>
// //                                                             {new Date(exam.start_time).toLocaleTimeString('bg-BG', { hour: '2-digit', minute: '2-digit' })} -
// //                                                             {new Date(exam.end_time).toLocaleTimeString('bg-BG', { hour: '2-digit', minute: '2-digit' })}
// //                                                         </strong></span>
// //                                                     </div>
// //                                                     <div className="d-flex align-items-center mb-2">
// //                                                         <i className="fas fa-university text-muted me-2"></i>
// //                                                         <span>Зала: <strong>{exam.hall?.name}</strong></span>
// //                                                     </div>
// //                                                     <div className="d-flex align-items-center">
// //                                                         <i className="fas fa-users text-muted me-2"></i>
// //                                                         <span className={exam.remainingSlots > 0 ? 'text-success' : 'text-danger'}>
// //                                                             <strong>{exam.remainingSlots}/{exam.max_students} места</strong>
// //                                                         </span>
// //                                                     </div>
// //                                                 </div>
// //
// //                                                 <button
// //                                                     className="btn btn-primary w-100"
// //                                                     onClick={() => openEditModal(exam.id)}
// //                                                     disabled={new Date(exam.start_time).getTime() - new Date().getTime() < 48 * 60 * 60 * 1000}
// //                                                 >
// //                                                     <i className="fas fa-file-pen me-2"></i>
// //                                                     Редактирай изпит
// //                                                 </button>
// //                                             </div>
// //                                         </div>
// //                                     </div>
// //                                 ))}
// //
// //                                 <div className="col-md-6 col-lg-4 mb-4 d-flex align-items-center justify-content-center">
// //                                     <button className="btn btn-primary rounded-circle" style={{ width: '80px', height: '80px' }} onClick={openCreateModal}>
// //                                         <i className="fas fa-plus"></i>
// //                                     </button>
// //                                 </div>
// //                             </div>
// //                         )}
// //
// //                         {showModal && (
// //                             <div className="modal fade show d-block" tabIndex="-1" style={{ backgroundColor: 'rgba(0,0,0,0.5)' }}>
// //                                 <div className="modal-dialog modal-lg">
// //                                     <div className="modal-content">
// //                                         <div className="modal-header">
// //                                             <h5 className="modal-title">{isEditing ? 'Редактиране на изпит' : 'Създаване на нов изпит'}</h5>
// //                                             <button type="button" className="btn-close" onClick={handleModalClose}></button>
// //                                         </div>
// //                                         <form onSubmit={handleSubmit}>
// //                                             <div className="modal-body">
// //                                                 <div className="row mb-3">
// //                                                     <div className="col-md-6">
// //                                                         <label className="form-label">Дисциплина</label>
// //                                                         <select
// //                                                             name="subject_id"
// //                                                             className="form-select"
// //                                                             value={formData.subject_id}
// //                                                             onChange={handleInputChange}
// //                                                             required
// //                                                             disabled={isEditing}
// //                                                         >
// //                                                             <option value="">Изберете дисциплина</option>
// //                                                             {subjects.map(subject => (
// //                                                                 <option key={subject.id} value={subject.id}>
// //                                                                     {subject.subject_name} (Сем. {subject.semester})
// //                                                                 </option>
// //                                                             ))}
// //                                                         </select>
// //                                                     </div>
// //                                                     <div className="col-md-6">
// //                                                         <label className="form-label">Тип изпит</label>
// //                                                         <select
// //                                                             name="exam_type"
// //                                                             className="form-select"
// //                                                             value={formData.exam_type}
// //                                                             onChange={handleInputChange}
// //                                                             required
// //                                                             disabled={isEditing}
// //                                                         >
// //                                                             <option value="редовен">Редовен</option>
// //                                                             <option value="поправителен">Поправителен</option>
// //                                                             <option value="ликвидация">Ликвидация</option>
// //                                                         </select>
// //                                                     </div>
// //                                                 </div>
// //
// //                                                 <div className="row mb-3">
// //                                                     <div className="col-md-6">
// //                                                         <label className="form-label">Макс. студенти</label>
// //                                                         <input
// //                                                             type="number"
// //                                                             name="max_students"
// //                                                             className="form-control"
// //                                                             value={formData.max_students}
// //                                                             onChange={handleInputChange}
// //                                                             min="1"
// //                                                             required
// //                                                         />
// //                                                     </div>
// //                                                     <div className="col-md-6">
// //                                                         <label className="form-label">Изпитна зала</label>
// //                                                         <select
// //                                                             name="hall_id"
// //                                                             className="form-select"
// //                                                             value={formData.hall_id}
// //                                                             onChange={handleHallChange}
// //                                                             required
// //                                                         >
// //                                                             <option value="">Изберете зала</option>
// //                                                             {halls.map(hall => (
// //                                                                 <option key={hall.id} value={hall.id}>
// //                                                                     {hall.name} ({hall.capacity} места)
// //                                                                 </option>
// //                                                             ))}
// //                                                         </select>
// //                                                     </div>
// //                                                 </div>
// //
// //                                                 <div className="mb-3">
// //                                                     <label className="form-label">Дата</label>
// //                                                     <input
// //                                                         type="date"
// //                                                         className="form-control"
// //                                                         value={selectedDate}
// //                                                         onChange={handleDateChange}
// //                                                         required
// //                                                     />
// //                                                 </div>
// //
// //                                                 <div className="mb-3">
// //                                                     <label className="form-label">Изберете свободни часове</label>
// //                                                     <div className="mt-2">
// //                                                         <h6 className="text-center">Стая: {formData.hall_id ? halls.find(h => h.id == formData.hall_id)?.name : '---'}</h6>
// //                                                         {loadingSlots ? (
// //                                                             <div className="text-center">
// //                                                                 <div className="spinner-border text-primary" role="status">
// //                                                                     <span className="visually-hidden">Зареждане...</span>
// //                                                                 </div>
// //                                                             </div>
// //                                                         ) : (
// //                                                             <div className="d-flex flex-wrap gap-2">
// //                                                                 {['07:00', '08:00', '09:00', '10:00', '11:00', '12:00', '13:00', '14:00', '15:00', '16:00', '17:00', '18:00'].map(time => {
// //                                                                     const isBooked = isTimeSlotBooked(time);
// //                                                                     const isSelected = selectedSlots.includes(time);
// //
// //                                                                     return (
// //                                                                         <button
// //                                                                             key={time}
// //                                                                             type="button"
// //                                                                             className={`btn ${isSelected ? 'btn-primary' : isBooked ? 'btn-danger' : 'btn-success'}`}
// //                                                                             style={{ width: '80px' }}
// //                                                                             disabled={isBooked}
// //                                                                             onClick={() => handleTimeSlotClick(time)}
// //                                                                         >
// //                                                                             {time}
// //                                                                         </button>
// //                                                                     );
// //                                                                 })}
// //                                                             </div>
// //                                                         )}
// //                                                         {selectedSlots.length > 0 && (
// //                                                             <div className="mt-3">
// //                                                                 <p className="mb-1">Избрани часове: {selectedSlots.sort().join(', ')}</p>
// //                                                                 <small className="text-muted">
// //                                                                     Продължителност: {selectedSlots.length} час{selectedSlots.length > 1 ? 'а' : ''}
// //                                                                 </small>
// //                                                             </div>
// //                                                         )}
// //                                                     </div>
// //                                                 </div>
// //
// //                                                 {Object.keys(errors).length > 0 && (
// //                                                     <div className="alert alert-danger">
// //                                                         {Object.values(errors).map((error, index) => (
// //                                                             <div key={index}>{error}</div>
// //                                                         ))}
// //                                                     </div>
// //                                                 )}
// //                                             </div>
// //                                             <div className="modal-footer">
// //                                                 <button type="button" className="btn btn-secondary" onClick={handleModalClose}>Отказ</button>
// //                                                 <button type="submit" className="btn btn-primary">
// //                                                     {isEditing ? 'Редактирай' : 'Създай'}
// //                                                 </button>
// //                                             </div>
// //                                         </form>
// //                                     </div>
// //                                 </div>
// //                             </div>
// //                         )}
// //                     </div>
// //                 </div>
// //             </div>
// //         </div>
// //     );
// // };
// //
// // export default TeacherDashboard;
// // src/components/TeacherDashboard.jsx
// import React, { useState, useEffect, useCallback, useMemo } from 'react';
// import { useAuth, api } from '../hooks/useAuth';
// import Header from './Header';
// import Sidebar from './Sidebar';
// // import '../app.css'; // ако не е глобално вкаран
//
// const TIME_SLOTS = ['07:00','08:00','09:00','10:00','11:00','12:00','13:00','14:00','15:00','16:00','17:00','18:00'];
//
// function formatDateTime(dt) {
//     const y = dt.getFullYear();
//     const m = String(dt.getMonth() + 1).padStart(2, '0');
//     const d = String(dt.getDate()).padStart(2, '0');
//     const hh = String(dt.getHours()).padStart(2, '0');
//     const mm = String(dt.getMinutes()).padStart(2, '0');
//     return `${y}-${m}-${d} ${hh}:${mm}:00`;
// }
//
// function isPastDate(dateStr) {
//     const today = new Date();
//     const d = new Date(`${dateStr}T00:00:00`);
//     return d.setHours(0,0,0,0) < new Date(today.getFullYear(), today.getMonth(), today.getDate()).getTime();
// }
// function isWithin48Hours(date) {
//     const now = new Date();
//     const diffH = Math.abs(date - now) / (1000 * 60 * 60);
//     return diffH < 48;
// }
// function isValidDate(dateStr, time = '00:00') {
//     const examDate = new Date(`${dateStr}T${time}:00`);
//     return !isPastDate(dateStr) && !isWithin48Hours(examDate);
// }
// // 45 мин на слот + 15 мин между слотовете
// function calculateExamDurationMinutes(slots) {
//     if (slots.length === 0) return 0;
//     return (slots.length * 45) + Math.max(slots.length - 1, 0) * 15;
// }
//
// export default function TeacherDashboard() {
//     const { user } = useAuth();
//     const [exams, setExams] = useState([]);
//     const [subjects, setSubjects] = useState([]);
//     const [halls, setHalls] = useState([]);
//
//     const [loading, setLoading] = useState(true);
//     const [fetchError, setFetchError] = useState(null);
//
//     const [showModal, setShowModal] = useState(false);
//     const [isEditing, setIsEditing] = useState(false);
//     const [currentExamId, setCurrentExamId] = useState(null);
//
//     const [formData, setFormData] = useState({
//         subject_id: '',
//         exam_type: 'редовен',
//         max_students: '',
//         hall_id: '',
//         start_time: '',
//         end_time: ''
//     });
//
//     const [selectedDate, setSelectedDate] = useState(new Date().toISOString().split('T')[0]);
//     const [selectedSlots, setSelectedSlots] = useState([]);
//     const [bookedSlots, setBookedSlots] = useState([]); // масив от ISO start/end или нормализирани часове
//     const [loadingSlots, setLoadingSlots] = useState(false);
//
//     // Зареждане на таблото
//     const fetchDashboardData = useCallback(async () => {
//         if (!user || user.role !== 'teacher') return;
//         try {
//             setLoading(true);
//             const res = await api.get('/upcoming_exams');
//             setExams(res.data.exams || []);
//             setSubjects(res.data.subjects || []);
//             setHalls(res.data.halls || []);
//             setFetchError(null);
//         } catch (e) {
//             setFetchError('Грешка при зареждане на данните');
//             console.error(e);
//         } finally {
//             setLoading(false);
//         }
//     }, [user]);
//
//     useEffect(() => {
//         if (user && user.role === 'teacher') fetchDashboardData();
//     }, [user, fetchDashboardData]);
//
//     // Зареждане на заетите слотове
//     const fetchBookedSlots = useCallback(async (hallId, date, excludeExamId = null) => {
//         if (!hallId || !date) return;
//         try {
//             setLoadingSlots(true);
//             let url = `/booked-slots?date=${date}&hall_id=${hallId}`;
//             if (excludeExamId) url += `&exclude_exam_id=${excludeExamId}`;
//             const { data } = await api.get(url);
//             console.log(data)
//             // Очакване: data = [{start: "2025-09-20 09:00:00", end: "2025-09-20 11:15:00"}, ...]
//             // setBookedSlots(Array.isArray(data) ? data : []);
//             setBookedSlots(data.bookedSlots || []);
//             console.log(bookedSlots)
//         } catch (e) {
//             console.error('Грешка при зареждане на заетите слотове:', e);
//             setBookedSlots([]);
//         } finally {
//             setLoadingSlots(false);
//         }
//     }, []);
//
//     // Нормализиране на заетите слотове до начални часове от TIME_SLOTS
//     const bookedStartTimesSet = useMemo(() => {
//         const s = new Set();
//         for (const slot of bookedSlots) {
//             if (!slot?.start) continue;
//             const t = new Date(slot.start).toLocaleTimeString('bg-BG', { hour: '2-digit', minute: '2-digit' });
//             s.add(t);
//         }
//         return s;
//     }, [bookedSlots]);
//
//     function isTimeSlotBooked(timeHHMM) {
//         return bookedStartTimesSet.has(timeHHMM);
//     }
//
//     // Последователно избиране на часови слотове (както в Blade)
//     function handleTimeSlotClick(time) {
//         // ако е „зает“ или инвалиден — exit
//         if (!isValidDate(selectedDate, time) || isTimeSlotBooked(time)) return;
//
//         const all = TIME_SLOTS.slice(); // вече сортирани
//         const idx = all.indexOf(time);
//         const already = selectedSlots.includes(time);
//
//         if (already) {
//             const i = selectedSlots.indexOf(time);
//             setSelectedSlots(selectedSlots.slice(0, i));
//         } else {
//             if (selectedSlots.length === 0) {
//                 setSelectedSlots([time]);
//             } else {
//                 const last = selectedSlots[selectedSlots.length - 1];
//                 const lastIdx = all.indexOf(last);
//                 if (idx === lastIdx + 1) {
//                     setSelectedSlots([...selectedSlots, time]);
//                 } else {
//                     setSelectedSlots([time]);
//                 }
//             }
//         }
//     }
//
//     // Когато се сменят selectedSlots/дата => изчисли старт/край
//     useEffect(() => {
//         if (selectedSlots.length === 0) {
//             setFormData(fd => ({ ...fd, start_time: '', end_time: '' }));
//             return;
//         }
//         const first = selectedSlots[0];
//         const start = new Date(`${selectedDate}T${first}:00`);
//         const minutes = calculateExamDurationMinutes(selectedSlots);
//         const end = new Date(start.getTime() + minutes * 60000);
//         setFormData(fd => ({
//             ...fd,
//             start_time: formatDateTime(start),
//             end_time: formatDateTime(end)
//         }));
//     }, [selectedSlots, selectedDate]);
//
//     // Промени по формата
//     function handleInputChange(e) {
//         const { name, value } = e.target;
//         setFormData(prev => ({ ...prev, [name]: value }));
//         if (name === 'hall_id') {
//             fetchBookedSlots(value, selectedDate, isEditing ? currentExamId : null);
//         }
//     }
//     function handleDateChange(e) {
//         const v = e.target.value;
//         setSelectedDate(v);
//         fetchBookedSlots(formData.hall_id, v, isEditing ? currentExamId : null);
//     }
//
//     // Submit
//     async function handleSubmit(e) {
//         e.preventDefault();
//         try {
//             const payload = { ...formData };
//             if (!isEditing) {
//                 await api.post('/examStore', payload);
//             } else {
//                 await api.put(`/edit-exams/${currentExamId}`, payload);
//
//             }
//             setShowModal(false);
//             await fetchDashboardData();
//         } catch (err) {
//             console.error('Save error', err);
//             alert('Възникна грешка при запис.');
//         }
//     }
//
//     // Reset / Open modal
//     function resetForm() {
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
//     }
//     function openCreateModal() {
//         resetForm();
//         setShowModal(true);
//     }
//     function openEditModal(exam) {
//         setIsEditing(true);
//         setCurrentExamId(exam.id);
//         setFormData({
//             subject_id: String(exam.subject_id ?? ''),
//             exam_type: exam.exam_type ?? 'редовен',
//             max_students: String(exam.max_students ?? ''),
//             hall_id: String(exam.hall_id ?? ''),
//             start_time: exam.start_time ?? '',
//             end_time: exam.end_time ?? ''
//         });
//
//         // derive date and approximate slots на стъпка 1ч.
//         const start = new Date(exam.start_time);
//         const end = new Date(exam.end_time);
//         const dateStr = `${start.getFullYear()}-${String(start.getMonth()+1).padStart(2,'0')}-${String(start.getDate()).padStart(2,'0')}`;
//         setSelectedDate(dateStr);
//
//         const startHH = String(start.getHours()).padStart(2, '0') + ':00';
//         const endHH = String(end.getHours()).padStart(2, '0') + ':00';
//         const startIdx = TIME_SLOTS.indexOf(startHH);
//         const endIdx = TIME_SLOTS.indexOf(endHH);
//         const sel = (startIdx >= 0 && endIdx >= startIdx) ? TIME_SLOTS.slice(startIdx, endIdx + 1) : [startHH];
//         setSelectedSlots(sel);
//
//         setShowModal(true);
//         fetchBookedSlots(exam.hall_id, dateStr, exam.id);
//     }
//
//     if (!user || user.role !== 'teacher') {
//         return (
//             <div className="min-h-screen bg-gradient-to-br from-indigo-50 to-blue-50">
//                 <Header />
//                 <div className="container mx-auto p-6">
//                     <div className="bg-red-50 text-red-700 border border-red-200 rounded-xl p-4">
//                         Нямате необходимите права за достъп до тази страница.
//                     </div>
//                 </div>
//             </div>
//         );
//     }
//
//     if (loading) {
//         return (
//             <div className="min-h-screen bg-gradient-to-br from-indigo-50 to-blue-50">
//                 <Header />
//                 <div className="flex items-center justify-center min-h-[calc(100vh-64px)]">
//                     <div className="animate-pulse text-indigo-600">Зареждане…</div>
//                 </div>
//             </div>
//         );
//     }
//
//     return (
//         <div className="min-h-screen bg-gradient-to-br from-indigo-50 to-blue-50 font-[Inter] overflow-x-hidden">
//             <Header />
//             <div className="page-layout">
//                 <Sidebar user={user} />
//
//                 <main className="p-4 lg:p-6 relative z-0">
//                     {/* Заглавен блок */}
//                     <div className="bg-white/90 backdrop-blur-md shadow-sm py-6 mb-8 rounded-xl border border-gray-100">
//                         <div className="flex flex-col md:flex-row justify-between items-start md:items-center px-6 gap-4">
//                             <div>
//                                 <h1 className="text-2xl font-bold text-gray-800">Управление на изпити</h1>
//                                 <p className="text-sm text-gray-500 mt-1">Преглед на предстоящи изпити и възможност за добавяне</p>
//                             </div>
//                             <a href="/conducted-exams"
//                                className="inline-flex items-center gap-1 px-4 py-2.5 bg-green-500 text-white rounded-lg shadow hover:bg-green-600 transition-colors">
//                                 <i className="fa-duotone fa-solid fa-folder-open"></i>
//                                 Изминали изпити
//                             </a>
//                         </div>
//                     </div>
//
//                     {/* Alerts placeholder (ако имаш компонент – сложи го тук) */}
//
//                     {/* Празно състояние / Грид с карти */}
//                     {!exams || exams.length === 0 ? (
//                         <div className="text-center p-8 bg-white border border-gray-100 shadow-sm rounded-xl">
//                             <i className="fas fa-calendar-plus text-4xl text-gray-300 mb-4"></i>
//                             <h3 className="text-lg font-medium text-gray-700 mb-2">Няма създадени изпити</h3>
//                             <button onClick={openCreateModal}
//                                     className="mt-4 bg-blue-600 text-white px-6 py-2.5 rounded-lg hover:bg-blue-700 transition-colors">
//                                 Нов изпит
//                             </button>
//                         </div>
//                     ) : (
//                         <>
//                             <div className="grid gap-6 grid-cols-1 sm:grid-cols-2 xl:grid-cols-3">
//                                 {exams.map((exam) => {
//                                     const startsInLessThan48h = isWithin48Hours(new Date(exam.start_time));
//                                     const badge = (
//                                         <span className="px-2 py-1 rounded-full text-xs font-medium bg-indigo-100 text-indigo-700">
//                       {exam.exam_type}
//                     </span>
//                                     );
//                                     // опит за remaining, ако имаш данни
//                                     const remaining = (exam.remainingSlots != null)
//                                         ? exam.remainingSlots
//                                         : (typeof exam.registrations_count === 'number'
//                                             ? Math.max(0, (exam.max_students ?? 0) - exam.registrations_count)
//                                             : null);
//
//                                     return (
//                                         <div key={exam.id}
//                                              className="flex flex-col bg-white border border-gray-100 rounded-xl p-6 hover:shadow-md transition-all hover:border-indigo-100 hover:-translate-y-0.5">
//                                             <div className="flex justify-between items-start gap-2 mb-3">
//                                                 <h2 className="text-lg font-semibold text-gray-900">
//                                                     {exam.subject?.subject_name}
//                                                     <span className="block text-sm font-normal text-gray-500 mt-1">
//                             {exam.subject?.semester ? `Семестър ${exam.subject.semester}` : ''}
//                           </span>
//                                                 </h2>
//                                                 {badge}
//                                             </div>
//
//                                             <div className="space-y-2 text-sm text-gray-700">
//                                                 <div className="flex items-center gap-2">
//                                                     <i className="fa-regular fa-calendar"></i>
//                                                     <span>{new Date(exam.start_time).toLocaleDateString('bg-BG')}</span>
//                                                 </div>
//                                                 <div className="flex items-center gap-2">
//                                                     <i className="fa-regular fa-clock"></i>
//                                                     <span>
//                             {new Date(exam.start_time).toLocaleTimeString('bg-BG', { hour: '2-digit', minute: '2-digit' })}
//                                                         {' – '}
//                                                         {new Date(exam.end_time).toLocaleTimeString('bg-BG', { hour: '2-digit', minute: '2-digit' })}
//                           </span>
//                                                 </div>
//                                                 <div className="flex items-center gap-2">
//                                                     <i className="fa-regular fa-location-dot"></i>
//                                                     <span>{exam.hall?.name}</span>
//                                                 </div>
//                                                 <div className="flex items-center gap-2">
//                                                     <i className="fa-regular fa-users"></i>
//                                                     {remaining != null ? (
//                                                         <span className={`font-medium ${remaining > 0 ? 'text-green-700' : 'text-red-700'}`}>
//                               {remaining}/{exam.max_students} места
//                             </span>
//                                                     ) : (
//                                                         <span className="text-gray-600">Макс. {exam.max_students} места</span>
//                                                     )}
//                                                 </div>
//                                             </div>
//
//                                             <button
//                                                 onClick={() => openEditModal(exam)}
//                                                 disabled={startsInLessThan48h}
//                                                 className={`mt-auto w-full px-4 py-2.5 rounded-xl text-white font-medium transition-colors duration-200
//                            ${startsInLessThan48h
//                                                     ? 'bg-gray-300 cursor-not-allowed'
//                                                     : 'bg-blue-600 hover:bg-blue-700'}`}
//                                                 title={startsInLessThan48h ? 'Редакция не е позволена по-малко от 48 часа преди началото' : ''}
//                                             >
//                                                 <i className="fa-solid fa-file-pen mr-2"></i> Редактирай изпит
//                                             </button>
//                                         </div>
//                                     );
//                                 })}
//                             </div>
//
//                             {/* Плаващ бутон за нов изпит */}
//                             <div className="flex items-center justify-center mt-8">
//                                 <button onClick={openCreateModal}
//                                         className="w-16 h-16 rounded-full bg-indigo-600 hover:bg-indigo-700 text-white shadow-xl flex items-center justify-center transition-all duration-300 hover:rotate-90">
//                                     <svg className="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24">
//                                         <path strokeLinecap="round" strokeLinejoin="round" strokeWidth="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/>
//                                     </svg>
//                                 </button>
//                             </div>
//                         </>
//                     )}
//
//                     {/* MODAL */}
//                     {showModal && (
//                         <div className="fixed inset-0 z-50 bg-black/50 backdrop-blur-sm flex items-center justify-center p-4" onMouseDown={(e)=>{ if(e.target === e.currentTarget) setShowModal(false)}}>
//                             <div className="bg-white rounded-xl shadow-2xl w-full max-w-2xl p-6 mx-4 relative">
//                                 <h3 className="text-xl font-bold text-gray-900 mb-4">{isEditing ? 'Редактиране на изпит' : 'Създаване на нов изпит'}</h3>
//
//                                 <form onSubmit={handleSubmit} className="space-y-4">
//                                     <div>
//                                         <label className="block text-sm font-medium text-gray-700 mb-2">Дисциплина</label>
//                                         <select
//                                             name="subject_id"
//                                             value={formData.subject_id}
//                                             onChange={handleInputChange}
//                                             required
//                                             disabled={isEditing}
//                                             className="w-full px-4 py-2 rounded-lg border border-gray-200 focus:ring-2 focus:ring-blue-500 transition-all"
//                                         >
//                                             <option value="">Изберете дисциплина</option>
//                                             {subjects.map(s => (
//                                                 <option key={s.id} value={s.id}>{s.subject_name}{s.semester ? ` (Сем. ${s.semester})` : ''}</option>
//                                             ))}
//                                         </select>
//                                     </div>
//
//                                     <div className="grid grid-cols-1 sm:grid-cols-2 gap-4">
//                                         <div>
//                                             <label className="block text-sm font-medium text-gray-700 mb-2">Тип изпит</label>
//                                             <select
//                                                 name="exam_type"
//                                                 value={formData.exam_type}
//                                                 onChange={handleInputChange}
//                                                 required
//                                                 className="w-full px-4 py-2 rounded-lg border border-gray-200 focus:ring-2 focus:ring-blue-500 transition-all"
//                                             >
//                                                 <option value="редовен">Редовен</option>
//                                                 <option value="поправителен">Поправителен</option>
//                                                 <option value="ликвидация">Ликвидация</option>
//                                             </select>
//                                         </div>
//                                         <div>
//                                             <label className="block text-sm font-medium text-gray-700 mb-2">Макс. студенти</label>
//                                             <input
//                                                 type="number"
//                                                 name="max_students"
//                                                 min="1"
//                                                 value={formData.max_students}
//                                                 onChange={handleInputChange}
//                                                 required
//                                                 className="w-full px-4 py-2 rounded-lg border border-gray-200 focus:ring-2 focus:ring-blue-500 transition-all"
//                                             />
//                                         </div>
//                                     </div>
//
//                                     <div>
//                                         <label className="block text-sm font-medium text-gray-700 mb-2">Изпитна зала</label>
//                                         <select
//                                             name="hall_id"
//                                             value={formData.hall_id}
//                                             onChange={handleInputChange}
//                                             required
//                                             className="w-full px-4 py-2 rounded-lg border border-gray-200 focus:ring-2 focus:ring-blue-500 transition-all"
//                                         >
//                                             <option value="">Изберете зала</option>
//                                             {halls.map(h => (
//                                                 <option key={h.id} value={h.id}>{h.name} ({h.capacity} места)</option>
//                                             ))}
//                                         </select>
//                                     </div>
//
//                                     <div>
//                                         <label className="block text-sm font-medium text-gray-700 mb-2">Дата</label>
//                                         <input
//                                             type="date"
//                                             value={selectedDate}
//                                             onChange={handleDateChange}
//                                             required
//                                             className="w-full px-4 py-2 rounded-lg border border-gray-200 focus:ring-2 focus:ring-blue-500 transition-all"
//                                         />
//                                     </div>
//
//                                     <div>
//                                         <label className="block text-sm font-medium text-gray-700 mb-2">Изберете свободни часове</label>
//                                         <div className="mt-2">
//                                             <h6 className="text-center text-sm text-gray-600">Стая: {formData.hall_id ? (halls.find(h => String(h.id) === String(formData.hall_id))?.name ?? '---') : '---'}</h6>
//
//                                             {loadingSlots ? (
//                                                 <div className="text-center py-4">
//                                                     <div className="inline-block animate-spin rounded-full h-6 w-6 border-2 border-indigo-600 border-t-transparent"></div>
//                                                 </div>
//                                             ) : (
//                                                 <div className="grid grid-cols-3 sm:grid-cols-4 gap-2">
//                                                     {TIME_SLOTS.map(time => {
//                                                         const booked = isTimeSlotBooked(time);
//                                                         const selected = selectedSlots.includes(time);
//                                                         const valid = isValidDate(selectedDate, time);
//
//                                                         const base = "time-slot py-3 rounded-lg text-white font-medium transition-colors";
//                                                         const color =
//                                                             selected ? "bg-blue-500 hover:bg-blue-600"
//                                                                 : booked ? "bg-red-400 cursor-not-allowed"
//                                                                     : valid ? "bg-green-500 hover:bg-green-600"
//                                                                         : "bg-gray-300 cursor-not-allowed";
//
//                                                         return (
//                                                             <button
//                                                                 key={time}
//                                                                 type="button"
//                                                                 className={`${base} ${color}`}
//                                                                 disabled={booked || !valid}
//                                                                 title={!valid ? "Моля, изберете валидни дата и час (не минало/под 48ч.)" : booked ? "Слотът е зает" : ""}
//                                                                 onClick={() => handleTimeSlotClick(time)}
//                                                             >
//                                                                 {time}
//                                                             </button>
//                                                         );
//                                                     })}
//                                                 </div>
//                                             )}
//
//                                             {selectedSlots.length > 0 && (
//                                                 <div className="mt-3 text-sm text-gray-600">
//                                                     <p className="mb-1">Избрани часове: {selectedSlots.join(', ')}</p>
//                                                     <small>
//                                                         Продължителност: {selectedSlots.length} час{selectedSlots.length > 1 ? 'а' : ''} =&nbsp;
//                                                         {calculateExamDurationMinutes(selectedSlots)} мин.
//                                                     </small>
//                                                 </div>
//                                             )}
//                                         </div>
//                                     </div>
//
//                                     {/* Скритите стойности са видими тук за дебъг */}
//                                     {/* <pre className="text-xs text-gray-500">{JSON.stringify(formData, null, 2)}</pre> */}
//
//                                     {/* Грешки/валидиране по необходимост */}
//
//                                     <div className="flex items-center justify-end gap-2 pt-2">
//                                         <button type="button"
//                                                 onClick={() => setShowModal(false)}
//                                                 className="px-4 py-2 rounded-lg border border-gray-300 text-gray-700 hover:bg-gray-50">
//                                             Отказ
//                                         </button>
//                                         <button type="submit"
//                                                 disabled={selectedSlots.length === 0 || !formData.hall_id || !formData.subject_id}
//                                                 className={`px-4 py-2.5 rounded-lg text-white font-medium transition-colors
//                               ${selectedSlots.length > 0 ? 'bg-blue-600 hover:bg-blue-700' : 'bg-gray-300 cursor-not-allowed'}`}>
//                                             {isEditing ? 'Редактирай' : 'Създай'}
//                                         </button>
//                                     </div>
//                                 </form>
//                             </div>
//                         </div>
//                     )}
//                 </main>
//             </div>
//         </div>
//     );
// }
// import React, { useState, useEffect, useCallback, useMemo } from 'react';
// import { useAuth, api } from '../hooks/useAuth';
// import Header from './Header';
// import Sidebar from './Sidebar';
//
// const TIME_SLOTS = ['07:00','08:00','09:00','10:00','11:00','12:00','13:00','14:00','15:00','16:00','17:00','18:00'];
//
// function formatDateTime(dt) {
//     const y = dt.getFullYear();
//     const m = String(dt.getMonth() + 1).padStart(2, '0');
//     const d = String(dt.getDate()).padStart(2, '0');
//     const hh = String(dt.getHours()).padStart(2, '0');
//     const mm = String(dt.getMinutes()).padStart(2, '0');
//     return `${y}-${m}-${d} ${hh}:${mm}:00`;
// }
//
// function isPastDate(dateStr) {
//     const today = new Date();
//     const d = new Date(`${dateStr}T00:00:00`);
//     return d.setHours(0,0,0,0) < new Date(today.getFullYear(), today.getMonth(), today.getDate()).getTime();
// }
//
// function isWithin48Hours(date) {
//     const now = new Date();
//     const diffH = Math.abs(date - now) / (1000 * 60 * 60);
//     return diffH < 48;
// }
//
// function isValidDate(dateStr, time = '00:00') {
//     const examDate = new Date(`${dateStr}T${time}:00`);
//     return !isPastDate(dateStr) && !isWithin48Hours(examDate);
// }
//
// function calculateExamDurationMinutes(slots) {
//     if (slots.length === 0) return 0;
//     return (slots.length * 45) + Math.max(slots.length - 1, 0) * 15;
// }
//
// export default function TeacherDashboard() {
//     const { user } = useAuth();
//     const [exams, setExams] = useState([]);
//     const [subjects, setSubjects] = useState([]);
//     const [halls, setHalls] = useState([]);
//     const [loading, setLoading] = useState(true);
//     const [fetchError, setFetchError] = useState(null);
//     const [showModal, setShowModal] = useState(false);
//     const [isEditing, setIsEditing] = useState(false);
//     const [currentExamId, setCurrentExamId] = useState(null);
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
//     const [loadingSlots, setLoadingSlots] = useState(false);
//
//     const fetchDashboardData = useCallback(async () => {
//         if (!user || user.role !== 'teacher') return;
//         try {
//             setLoading(true);
//             const res = await api.get('/upcoming_exams');
//             setExams(res.data.exams || []);
//             setSubjects(res.data.subjects || []);
//             setHalls(res.data.halls || []);
//             setFetchError(null);
//         } catch (e) {
//             setFetchError('Грешка при зареждане на данните');
//             console.error(e);
//         } finally {
//             setLoading(false);
//         }
//     }, [user]);
//
//     useEffect(() => {
//         if (user && user.role === 'teacher') fetchDashboardData();
//     }, [user, fetchDashboardData]);
//
//     const fetchBookedSlots = useCallback(async (hallId, date, excludeExamId = null) => {
//         if (!hallId || !date) return;
//         try {
//             setLoadingSlots(true);
//             let url = `/booked-slots?date=${date}&hall_id=${hallId}`;
//             if (excludeExamId) url += `&exclude_exam_id=${excludeExamId}`;
//             const { data } = await api.get(url);
//             setBookedSlots(data.bookedSlots || []);
//         } catch (e) {
//             console.error('Грешка при зареждане на заетите слотове:', e);
//             setBookedSlots([]);
//         } finally {
//             setLoadingSlots(false);
//         }
//     }, []);
//
//     const bookedStartTimesSet = useMemo(() => {
//         const s = new Set();
//         for (const slot of bookedSlots) {
//             if (!slot?.start) continue;
//             const t = new Date(slot.start).toLocaleTimeString('bg-BG', { hour: '2-digit', minute: '2-digit' });
//             s.add(t);
//         }
//         return s;
//     }, [bookedSlots]);
//
//     function isTimeSlotBooked(timeHHMM) {
//         return bookedStartTimesSet.has(timeHHMM);
//     }
//
//     function handleTimeSlotClick(time) {
//         if (!isValidDate(selectedDate, time) || isTimeSlotBooked(time)) return;
//
//         const all = TIME_SLOTS.slice();
//         const idx = all.indexOf(time);
//         const already = selectedSlots.includes(time);
//
//         if (already) {
//             const i = selectedSlots.indexOf(time);
//             setSelectedSlots(selectedSlots.slice(0, i));
//         } else {
//             if (selectedSlots.length === 0) {
//                 setSelectedSlots([time]);
//             } else {
//                 const last = selectedSlots[selectedSlots.length - 1];
//                 const lastIdx = all.indexOf(last);
//                 if (idx === lastIdx + 1) {
//                     setSelectedSlots([...selectedSlots, time]);
//                 } else {
//                     setSelectedSlots([time]);
//                 }
//             }
//         }
//     }
//
//     useEffect(() => {
//         if (selectedSlots.length === 0) {
//             setFormData(fd => ({ ...fd, start_time: '', end_time: '' }));
//             return;
//         }
//         const first = selectedSlots[0];
//         const start = new Date(`${selectedDate}T${first}:00`);
//         const minutes = calculateExamDurationMinutes(selectedSlots);
//         const end = new Date(start.getTime() + minutes * 60000);
//         setFormData(fd => ({
//             ...fd,
//             start_time: formatDateTime(start),
//             end_time: formatDateTime(end)
//         }));
//     }, [selectedSlots, selectedDate]);
//
//     function handleInputChange(e) {
//         const { name, value } = e.target;
//         setFormData(prev => ({ ...prev, [name]: value }));
//         if (name === 'hall_id') {
//             fetchBookedSlots(value, selectedDate, isEditing ? currentExamId : null);
//         }
//     }
//
//     function handleDateChange(e) {
//         const v = e.target.value;
//         setSelectedDate(v);
//         fetchBookedSlots(formData.hall_id, v, isEditing ? currentExamId : null);
//     }
//
//     async function handleSubmit(e) {
//         e.preventDefault();
//         try {
//             const payload = { ...formData };
//             if (!isEditing) {
//                 await api.post('/examStore', payload);
//             } else {
//                 await api.put(`/edit-exams/${currentExamId}`, payload);
//             }
//             setShowModal(false);
//             await fetchDashboardData();
//         } catch (err) {
//             console.error('Save error', err);
//             alert('Възникна грешка при запис.');
//         }
//     }
//
//     function resetForm() {
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
//     }
//
//     function openCreateModal() {
//         resetForm();
//         setShowModal(true);
//     }
//
//     function openEditModal(exam) {
//         setIsEditing(true);
//         setCurrentExamId(exam.id);
//         setFormData({
//             subject_id: String(exam.subject_id ?? ''),
//             exam_type: exam.exam_type ?? 'редовен',
//             max_students: String(exam.max_students ?? ''),
//             hall_id: String(exam.hall_id ?? ''),
//             start_time: exam.start_time ?? '',
//             end_time: exam.end_time ?? ''
//         });
//
//         const start = new Date(exam.start_time);
//         const end = new Date(exam.end_time);
//         const dateStr = `${start.getFullYear()}-${String(start.getMonth()+1).padStart(2,'0')}-${String(start.getDate()).padStart(2,'0')}`;
//         setSelectedDate(dateStr);
//
//         const startHH = String(start.getHours()).padStart(2, '0') + ':00';
//         const endHH = String(end.getHours()).padStart(2, '0') + ':00';
//         const startIdx = TIME_SLOTS.indexOf(startHH);
//         const endIdx = TIME_SLOTS.indexOf(endHH);
//         const sel = (startIdx >= 0 && endIdx >= startIdx) ? TIME_SLOTS.slice(startIdx, endIdx + 1) : [startHH];
//         setSelectedSlots(sel);
//
//         setShowModal(true);
//         fetchBookedSlots(exam.hall_id, dateStr, exam.id);
//     }
//
//     if (!user || user.role !== 'teacher') {
//         return (
//             <div className="min-h-screen bg-gradient-to-br from-indigo-50 to-blue-50">
//                 <Header />
//                 <div className="container mx-auto p-6">
//                     <div className="bg-red-50 text-red-700 border border-red-200 rounded-xl p-4">
//                         Нямате необходимите права за достъп до тази страница.
//                     </div>
//                 </div>
//             </div>
//         );
//     }
//
//     if (loading) {
//         return (
//             <div className="min-h-screen bg-gradient-to-br from-indigo-50 to-blue-50">
//                 <Header />
//                 <div className="flex items-center justify-center min-h-[calc(100vh-64px)]">
//                     <div className="animate-pulse text-indigo-600">Зареждане…</div>
//                 </div>
//             </div>
//         );
//     }
//
// //     return (
// //         <div className="min-h-screen bg-gradient-to-br from-indigo-50 to-blue-50 font-[Inter] overflow-x-hidden">
// //             <Header />
// //             <div className="page-layout">
// //                 <Sidebar user={user} />
// //
// //                 <main className="p-4 lg:p-6 relative z-0">
// //                     <div className="bg-white/90 backdrop-blur-md shadow-sm py-6 mb-8 rounded-xl border border-gray-100">
// //                         <div className="flex flex-col md:flex-row justify-between items-start md:items-center px-6 gap-4">
// //                             <div>
// //                                 <h1 className="text-2xl font-bold text-gray-800">Управление на изпити</h1>
// //                                 <p className="text-sm text-gray-500 mt-1">Преглед на предстоящи изпити и възможност за добавяне</p>
// //                             </div>
// //                             <a href="/conducted-exams"
// //                                className="inline-flex items-center gap-1 px-4 py-2.5 bg-green-500 text-white rounded-lg shadow hover:bg-green-600 transition-colors">
// //                                 <i className="fa-duotone fa-solid fa-folder-open"></i>
// //                                 Изминали изпити
// //                             </a>
// //                         </div>
// //                     </div>
// //
// //                     {!exams || exams.length === 0 ? (
// //                         <div className="text-center p-8 bg-white border border-gray-100 shadow-sm rounded-xl">
// //                             <i className="fas fa-calendar-plus text-4xl text-gray-300 mb-4"></i>
// //                             <h3 className="text-lg font-medium text-gray-700 mb-2">Няма създадени изпити</h3>
// //                             <button onClick={openCreateModal}
// //                                     className="mt-4 bg-blue-600 text-white px-6 py-2.5 rounded-lg hover:bg-blue-700 transition-colors">
// //                                 Нов изпит
// //                             </button>
// //                         </div>
// //                     ) : (
// //                         <>
// //                             <div className="grid gap-6 grid-cols-1 sm:grid-cols-2 xl:grid-cols-3">
// //                                 {exams.map((exam) => {
// //                                     const startsInLessThan48h = isWithin48Hours(new Date(exam.start_time));
// //                                     const badge = (
// //                                         <span className="px-2 py-1 rounded-full text-xs font-medium bg-indigo-100 text-indigo-700">
// //                       {exam.exam_type}
// //                     </span>
// //                                     );
// //                                     const remaining = (exam.remainingSlots != null)
// //                                         ? exam.remainingSlots
// //                                         : (typeof exam.registrations_count === 'number'
// //                                             ? Math.max(0, (exam.max_students ?? 0) - exam.registrations_count)
// //                                             : null);
// //
// //                                     return (
// //                                         <div key={exam.id}
// //                                              className="flex flex-col bg-white border border-gray-100 rounded-xl p-6 hover:shadow-md transition-all hover:border-indigo-100 hover:-translate-y-0.5">
// //                                             <div className="flex justify-between items-start gap-2 mb-3">
// //                                                 <h2 className="text-lg font-semibold text-gray-900">
// //                                                     {exam.subject?.subject_name}
// //                                                     <span className="block text-sm font-normal text-gray-500 mt-1">
// //                             {exam.subject?.semester ? `Семестър ${exam.subject.semester}` : ''}
// //                           </span>
// //                                                 </h2>
// //                                                 {badge}
// //                                             </div>
// //
// //                                             <div className="space-y-2 text-sm text-gray-700">
// //                                                 <div className="flex items-center gap-2">
// //                                                     <i className="fa-regular fa-calendar"></i>
// //                                                     <span>{new Date(exam.start_time).toLocaleDateString('bg-BG')}</span>
// //                                                 </div>
// //                                                 <div className="flex items-center gap-2">
// //                                                     <i className="fa-regular fa-clock"></i>
// //                                                     <span>
// //                             {new Date(exam.start_time).toLocaleTimeString('bg-BG', { hour: '2-digit', minute: '2-digit' })}
// //                                                         {' – '}
// //                                                         {new Date(exam.end_time).toLocaleTimeString('bg-BG', { hour: '2-digit', minute: '2-digit' })}
// //                           </span>
// //                                                 </div>
// //                                                 <div className="flex items-center gap-2">
// //                                                     <i className="fa-regular fa-location-dot"></i>
// //                                                     <span>{exam.hall?.name}</span>
// //                                                 </div>
// //                                                 <div className="flex items-center gap-2">
// //                                                     <i className="fa-regular fa-users"></i>
// //                                                     {remaining != null ? (
// //                                                         <span className={`font-medium ${remaining > 0 ? 'text-green-700' : 'text-red-700'}`}>
// //                               {remaining}/{exam.max_students} места
// //                             </span>
// //                                                     ) : (
// //                                                         <span className="text-gray-600">Макс. {exam.max_students} места</span>
// //                                                     )}
// //                                                 </div>
// //                                             </div>
// //
// //                                             <button
// //                                                 onClick={() => openEditModal(exam)}
// //                                                 disabled={startsInLessThan48h}
// //                                                 className={`mt-auto w-full px-4 py-2.5 rounded-xl text-white font-medium transition-colors duration-200
// //                            ${startsInLessThan48h
// //                                                     ? 'bg-gray-300 cursor-not-allowed'
// //                                                     : 'bg-blue-600 hover:bg-blue-700'}`}
// //                                                 title={startsInLessThan48h ? 'Редакция не е позволена по-малко от 48 часа преди началото' : ''}
// //                                             >
// //                                                 <i className="fa-solid fa-file-pen mr-2"></i> Редактирай изпит
// //                                             </button>
// //                                         </div>
// //                                     );
// //                                 })}
// //                             </div>
// //
// //                             <div className="flex items-center justify-center mt-8">
// //                                 <button onClick={openCreateModal}
// //                                         className="w-16 h-16 rounded-full bg-indigo-600 hover:bg-indigo-700 text-white shadow-xl flex items-center justify-center transition-all duration-300 hover:rotate-90">
// //                                     <svg className="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24">
// //                                         <path strokeLinecap="round" strokeLinejoin="round" strokeWidth="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/>
// //                                     </svg>
// //                                 </button>
// //                             </div>
// //                         </>
// //                     )}
// //
// //                     {showModal && (
// //                         <div className="fixed inset-0 z-50 bg-black/50 backdrop-blur-sm flex items-center justify-center p-4" onMouseDown={(e)=>{ if(e.target === e.currentTarget) setShowModal(false)}}>
// //                             <div className="bg-white rounded-xl shadow-2xl w-full max-w-2xl p-6 mx-4 relative">
// //                                 <h3 className="text-xl font-bold text-gray-900 mb-4">{isEditing ? 'Редактиране на изпит' : 'Създаване на нов изпит'}</h3>
// //
// //                                 <form onSubmit={handleSubmit} className="space-y-4">
// //                                     <div>
// //                                         <label className="block text-sm font-medium text-gray-700 mb-2">Дисциплина</label>
// //                                         <select
// //                                             name="subject_id"
// //                                             value={formData.subject_id}
// //                                             onChange={handleInputChange}
// //                                             required
// //                                             disabled={isEditing}
// //                                             className="w-full px-4 py-2 rounded-lg border border-gray-200 focus:ring-2 focus:ring-blue-500 transition-all"
// //                                         >
// //                                             <option value="">Изберете дисциплина</option>
// //                                             {subjects.map(s => (
// //                                                 <option key={s.id} value={s.id}>{s.subject_name}{s.semester ? ` (Сем. ${s.semester})` : ''}</option>
// //                                             ))}
// //                                         </select>
// //                                     </div>
// //
// //                                     <div className="grid grid-cols-1 sm:grid-cols-2 gap-4">
// //                                         <div>
// //                                             <label className="block text-sm font-medium text-gray-700 mb-2">Тип изпит</label>
// //                                             <select
// //                                                 name="exam_type"
// //                                                 value={formData.exam_type}
// //                                                 onChange={handleInputChange}
// //                                                 required
// //                                                 className="w-full px-4 py-2 rounded-lg border border-gray-200 focus:ring-2 focus:ring-blue-500 transition-all"
// //                                             >
// //                                                 <option value="редовен">Редовен</option>
// //                                                 <option value="поправителен">Поправителен</option>
// //                                                 <option value="ликвидация">Ликвидация</option>
// //                                             </select>
// //                                         </div>
// //                                         <div>
// //                                             <label className="block text-sm font-medium text-gray-700 mb-2">Макс. студенти</label>
// //                                             <input
// //                                                 type="number"
// //                                                 name="max_students"
// //                                                 min="1"
// //                                                 value={formData.max_students}
// //                                                 onChange={handleInputChange}
// //                                                 required
// //                                                 className="w-full px-4 py-2 rounded-lg border border-gray-200 focus:ring-2 focus:ring-blue-500 transition-all"
// //                                             />
// //                                         </div>
// //                                     </div>
// //
// //                                     <div>
// //                                         <label className="block text-sm font-medium text-gray-700 mb-2">Изпитна зала</label>
// //                                         <select
// //                                             name="hall_id"
// //                                             value={formData.hall_id}
// //                                             onChange={handleInputChange}
// //                                             required
// //                                             className="w-full px-4 py-2 rounded-lg border border-gray-200 focus:ring-2 focus:ring-blue-500 transition-all"
// //                                         >
// //                                             <option value="">Изберете зала</option>
// //                                             {halls.map(h => (
// //                                                 <option key={h.id} value={h.id}>{h.name} ({h.capacity} места)</option>
// //                                             ))}
// //                                         </select>
// //                                     </div>
// //
// //                                     <div>
// //                                         <label className="block text-sm font-medium text-gray-700 mb-2">Дата</label>
// //                                         <input
// //                                             type="date"
// //                                             value={selectedDate}
// //                                             onChange={handleDateChange}
// //                                             required
// //                                             className="w-full px-4 py-2 rounded-lg border border-gray-200 focus:ring-2 focus:ring-blue-500 transition-all"
// //                                         />
// //                                     </div>
// //
// //                                     <div>
// //                                         <label className="block text-sm font-medium text-gray-700 mb-2">Изберете свободни часове</label>
// //                                         <div className="mt-2">
// //                                             <h6 className="text-center text-sm text-gray-600">Стая: {formData.hall_id ? (halls.find(h => String(h.id) === String(formData.hall_id))?.name ?? '---') : '---'}</h6>
// //
// //                                             {loadingSlots ? (
// //                                                 <div className="text-center py-4">
// //                                                     <div className="inline-block animate-spin rounded-full h-6 w-6 border-2 border-indigo-600 border-t-transparent"></div>
// //                                                 </div>
// //                                             ) : (
// //                                                 <div className="grid grid-cols-3 sm:grid-cols-4 gap-2">
// //                                                     {TIME_SLOTS.map(time => {
// //                                                         const booked = isTimeSlotBooked(time);
// //                                                         const selected = selectedSlots.includes(time);
// //                                                         const valid = isValidDate(selectedDate, time);
// //
// //                                                         const base = "time-slot py-3 rounded-lg text-white font-medium transition-colors";
// //                                                         const color =
// //                                                             selected ? "bg-blue-500 hover:bg-blue-600"
// //                                                                 : booked ? "bg-red-400 cursor-not-allowed"
// //                                                                     : valid ? "bg-green-500 hover:bg-green-600"
// //                                                                         : "bg-gray-300 cursor-not-allowed";
// //
// //                                                         return (
// //                                                             <button
// //                                                                 key={time}
// //                                                                 type="button"
// //                                                                 className={`${base} ${color}`}
// //                                                                 disabled={booked || !valid}
// //                                                                 title={!valid ? "Моля, изберете валидни дата и час (не минало/под 48ч.)" : booked ? "Слотът е зает" : ""}
// //                                                                 onClick={() => handleTimeSlotClick(time)}
// //                                                             >
// //                                                                 {time}
// //                                                             </button>
// //                                                         );
// //                                                     })}
// //                                                 </div>
// //                                             )}
// //
// //                                             {selectedSlots.length > 0 && (
// //                                                 <div className="mt-3 text-sm text-gray-600">
// //                                                     <p className="mb-1">Избрани часове: {selectedSlots.join(', ')}</p>
// //                                                     <small>
// //                                                         Продължителност: {selectedSlots.length} час{selectedSlots.length > 1 ? 'а' : ''} =&nbsp;
// //                                                         {calculateExamDurationMinutes(selectedSlots)} мин.
// //                                                     </small>
// //                                                 </div>
// //                                             )}
// //                                         </div>
// //                                     </div>
// //
// //                                     <div className="flex items-center justify-end gap-2 pt-2">
// //                                         <button type="button"
// //                                                 onClick={() => setShowModal(false)}
// //                                                 className="px-4 py-2 rounded-lg border border-gray-300 text-gray-700 hover:bg-gray-50">
// //                                             Отказ
// //                                         </button>
// //                                         <button type="submit"
// //                                                 disabled={selectedSlots.length === 0 || !formData.hall_id || !formData.subject_id}
// //                                                 className={`px-4 py-2.5 rounded-lg text-white font-medium transition-colors
// //                               ${selectedSlots.length > 0 ? 'bg-blue-600 hover:bg-blue-700' : 'bg-gray-300 cursor-not-allowed'}`}>
// //                                             {isEditing ? 'Редактирай' : 'Създай'}
// //                                         </button>
// //                                     </div>
// //                                 </form>
// //                             </div>
// //                         </div>
// //                     )}
// //                 </main>
// //             </div>
// //         </div>
// //     );
// // }
//     return (
//         <div className="min-h-screen bg-gradient-to-br from-indigo-50 to-blue-50 font-[Inter] overflow-x-hidden">
//             <Header />
//             <div className="page-layout">
//                 <Sidebar user={user} />
//
//                 <main className="p-4 lg:p-6 relative z-0">
//                     {/* Заглавен блок */}
//                     <div className="bg-white/90 backdrop-blur-md shadow-sm py-6 mb-8 rounded-xl border border-gray-100">
//                         <div className="flex flex-col md:flex-row justify-between items-start md:items-center px-6 gap-4">
//                             <div>
//                                 <h1 className="text-2xl font-bold text-gray-800">Управление на изпити</h1>
//                                 <p className="text-sm text-gray-500 mt-1">Преглед на предстоящи изпити и възможност за добавяне</p>
//                             </div>
//                             <a href="/conducted-exams"
//                                className="inline-flex items-center gap-1 px-4 py-2.5 bg-green-500 text-white rounded-lg shadow hover:bg-green-600 transition-colors">
//                                 <i className="fa-duotone fa-solid fa-folder-open"></i>
//                                 Изминали изпити
//                             </a>
//                         </div>
//                     </div>
//
//                     {!exams || exams.length === 0 ? (
//                         <div className="text-center p-8 bg-white border border-gray-100 shadow-sm rounded-xl">
//                             <i className="fas fa-calendar-plus text-4xl text-gray-300 mb-4"></i>
//                             <h3 className="text-lg font-medium text-gray-700 mb-2">Няма създадени изпити</h3>
//                             <button onClick={openCreateModal}
//                                     className="mt-4 bg-blue-600 text-white px-6 py-2.5 rounded-lg hover:bg-blue-700 transition-colors">
//                                 Нов изпит
//                             </button>
//                         </div>
//                     ) : (
//                         <>
//                             <div className="grid gap-6 grid-cols-1 sm:grid-cols-2 xl:grid-cols-3">
//                                 {exams.map((exam) => {
//                                     const startsInLessThan48h = isWithin48Hours(new Date(exam.start_time));
//
//                                     return (
//                                         <div key={exam.id}
//                                              className="flex flex-col bg-white border border-gray-100 rounded-xl p-6 hover:shadow-md transition-all hover:border-primary-100 hover:-translate-y-0.5">
//                                             <div className="flex justify-between items-start gap-2 mb-3">
//                                                 <h2 className="text-lg font-semibold text-gray-900">
//                                                     {exam.subject?.subject_name}
//                                                     <span className="block text-sm font-normal text-gray-500 mt-1">
//                                                         {exam.subject?.description}
//                                                     </span>
//                                                 </h2>
//                                                 <span className="px-2.5 py-1 rounded-full text-xs font-medium bg-purple-100 text-purple-800">
//                                                     {exam.exam_type}
//                                                 </span>
//                                             </div>
//
//                                             <div className="space-y-3 mb-5">
//                                                 <div className="flex items-center gap-2 text-gray-600">
//                                                     <i className="fas fa-calendar-alt w-5 text-gray-400"></i>
//                                                     <span>Дата: <span className="font-medium text-gray-800">
//                                                         {new Date(exam.start_time).toLocaleDateString('bg-BG')}
//                                                     </span></span>
//                                                 </div>
//                                                 <div className="flex items-center gap-2 text-gray-600">
//                                                     <i className="fas fa-clock w-5 text-gray-400"></i>
//                                                     <span>Час: <span className="font-medium text-gray-800">
//                                                         {new Date(exam.start_time).toLocaleTimeString('bg-BG', { hour: '2-digit', minute: '2-digit' })} -
//                                                         {new Date(exam.end_time).toLocaleTimeString('bg-BG', { hour: '2-digit', minute: '2-digit' })}
//                                                     </span></span>
//                                                 </div>
//                                                 <div className="flex items-center gap-2 text-gray-600">
//                                                     <i className="fas fa-university w-5 text-gray-400"></i>
//                                                     <span>Зала: <span className="font-medium text-gray-800">{exam.hall?.name}</span></span>
//                                                 </div>
//                                                 <div className="flex items-center gap-2 text-gray-600">
//                                                     <i className="fas fa-users w-5 text-gray-400"></i>
//                                                     <span className={`font-medium ${exam.remainingSlots > 0 ? 'text-green-700' : 'text-red-700'}`}>
//                                                         {exam.remainingSlots}/{exam.max_students} места
//                                                     </span>
//                                                 </div>
//                                             </div>
//
//                                             <button
//                                                 onClick={() => openEditModal(exam)}
//                                                 disabled={startsInLessThan48h}
//                                                 className={`mt-auto w-full px-4 py-2.5 rounded-xl text-white font-medium transition-colors duration-200
//                                                     ${startsInLessThan48h
//                                                     ? 'bg-gray-300 cursor-not-allowed'
//                                                     : 'bg-blue-600 hover:bg-blue-700'}`}
//                                                 title={startsInLessThan48h ? 'Редакция не е позволена по-малко от 48 часа преди началото' : ''}
//                                             >
//                                                 <i className="fa-solid fa-file-pen mr-2"></i> Редактирай изпит
//                                             </button>
//                                         </div>
//                                     );
//                                 })}
//                             </div>
//
//                             {/* Бутон за създаване - позициониран като в Blade */}
//                             <div className="flex items-center justify-center mt-6">
//                                 <button onClick={openCreateModal}
//                                         className="w-16 h-16 rounded-full bg-indigo-600 hover:bg-indigo-700 text-white shadow-xl flex items-center justify-center transition-all duration-300 hover:rotate-90">
//                                     <svg className="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24">
//                                         <path strokeLinecap="round" strokeLinejoin="round" strokeWidth="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/>
//                                     </svg>
//                                 </button>
//                             </div>
//                         </>
//                     )}
//
//                     {/* Модален прозорец - актуализиран спрямо Blade шаблона */}
//                     {showModal && (
//                         <div className="fixed inset-0 z-50 bg-black/50 backdrop-blur-sm flex items-center justify-center p-4"
//                              onClick={() => setShowModal(false)}>
//                             <div className="bg-white rounded-xl shadow-2xl w-full max-w-md p-6 mx-4 relative"
//                                  onClick={e => e.stopPropagation()}>
//
//                                 <h3 className="text-xl font-bold text-gray-900 mb-4">
//                                     {isEditing ? 'Редактиране на изпит' : 'Създаване на нов изпит'}
//                                 </h3>
//
//                                 <form onSubmit={handleSubmit} className="space-y-4">
//                                     <div>
//                                         <label className="block text-sm font-medium text-gray-700 mb-2">Дисциплина</label>
//                                         <select
//                                             name="subject_id"
//                                             value={formData.subject_id}
//                                             onChange={handleInputChange}
//                                             required
//                                             disabled={isEditing}
//                                             className="w-full px-4 py-2 rounded-lg border border-gray-200 focus:ring-2 focus:ring-blue-500 transition-all"
//                                         >
//                                             <option value="">Изберете дисциплина</option>
//                                             {subjects.map(s => (
//                                                 <option key={s.id} value={s.id}>
//                                                     {s.subject_name} {s.semester && `(Сем. ${s.semester})`}
//                                                 </option>
//                                             ))}
//                                         </select>
//                                     </div>
//
//                                     <div className="grid grid-cols-2 gap-4">
//                                         <div>
//                                             <label className="block text-sm font-medium text-gray-700 mb-2">Тип изпит</label>
//                                             <select
//                                                 name="exam_type"
//                                                 value={formData.exam_type}
//                                                 onChange={handleInputChange}
//                                                 required
//                                                 disabled={isEditing}
//                                                 className="w-full px-4 py-2 rounded-lg border border-gray-200 focus:ring-2 focus:ring-blue-500 transition-all"
//                                             >
//                                                 <option value="редовен">Редовен</option>
//                                                 <option value="поправителен">Поправителен</option>
//                                                 <option value="ликвидация">Ликвидация</option>
//                                             </select>
//                                         </div>
//                                         <div>
//                                             <label className="block text-sm font-medium text-gray-700 mb-2">Макс. студенти</label>
//                                             <input
//                                                 type="number"
//                                                 name="max_students"
//                                                 min="1"
//                                                 value={formData.max_students}
//                                                 onChange={handleInputChange}
//                                                 required
//                                                 className="w-full px-4 py-2 rounded-lg border border-gray-200 focus:ring-2 focus:ring-blue-500 transition-all"
//                                             />
//                                         </div>
//                                     </div>
//
//                                     <div>
//                                         <label className="block text-sm font-medium text-gray-700 mb-2">Изпитна зала</label>
//                                         <select
//                                             name="hall_id"
//                                             value={formData.hall_id}
//                                             onChange={handleInputChange}
//                                             required
//                                             className="w-full px-4 py-2 rounded-lg border border-gray-200 focus:ring-2 focus:ring-blue-500 transition-all"
//                                         >
//                                             <option value="">Изберете зала</option>
//                                             {halls.map(h => (
//                                                 <option key={h.id} value={h.id}>
//                                                     {h.name} ({h.capacity} места)
//                                                 </option>
//                                             ))}
//                                         </select>
//                                     </div>
//
//                                     <div>
//                                         <label className="block text-sm font-medium text-gray-700 mb-2">Дата</label>
//                                         <input
//                                             type="date"
//                                             value={selectedDate}
//                                             onChange={handleDateChange}
//                                             required
//                                             className="w-full px-4 py-2 rounded-lg border border-gray-200 focus:ring-2 focus:ring-blue-500 transition-all"
//                                         />
//                                     </div>
//
//                                     <div>
//                                         <label className="block text-sm font-medium text-gray-700 mb-2">Изберете свободни часове</label>
//                                         <div className="mt-2">
//                                             <h4 className="text-center font-medium mb-2">
//                                                 Стая <span>
//                                                     {formData.hall_id ? halls.find(h => h.id == formData.hall_id)?.name : '---'}
//                                                 </span>
//                                             </h4>
//
//                                             {loadingSlots ? (
//                                                 <div className="text-center py-4">
//                                                     <i className="fas fa-spinner fa-spin text-blue-500 mr-2"></i>
//                                                     <span className="text-gray-600">Зареждане на слотове...</span>
//                                                 </div>
//                                             ) : (
//                                                 <div className="grid grid-cols-3 gap-2">
//                                                     {TIME_SLOTS.map(time => {
//                                                         const isBooked = isTimeSlotBooked(time);
//                                                         const isSelected = selectedSlots.includes(time);
//                                                         const isValid = isValidDate(selectedDate, time);
//
//                                                         return (
//                                                             <button
//                                                                 key={time}
//                                                                 type="button"
//                                                                 className={`py-3 rounded-lg text-white font-medium transition-colors
//                                                                     ${isSelected ? 'bg-blue-500' :
//                                                                     isBooked ? 'bg-red-500 cursor-not-allowed' :
//                                                                         isValid ? 'bg-green-500 hover:bg-green-600' :
//                                                                             'bg-gray-300 cursor-not-allowed'}`}
//                                                                 disabled={isBooked || !isValid}
//                                                                 onClick={() => handleTimeSlotClick(time)}
//                                                                 title={!isValid ? "Моля, изберете валидни дата и час за изпита." : ""}
//                                                             >
//                                                                 {time}
//                                                             </button>
//                                                         );
//                                                     })}
//                                                 </div>
//                                             )}
//                                         </div>
//                                     </div>
//
//                                     <div className="flex justify-end gap-3 mt-6">
//                                         <button type="button"
//                                                 onClick={() => setShowModal(false)}
//                                                 className="px-5 py-2.5 text-gray-600 hover:bg-gray-50 rounded-lg transition-colors">
//                                             Отказ
//                                         </button>
//                                         <button type="submit"
//                                                 className="px-5 py-2.5 bg-blue-600 hover:bg-blue-700 text-white rounded-lg transition-colors">
//                                             {isEditing ? 'Редактирай' : 'Създай'}
//                                         </button>
//                                     </div>
//                                 </form>
//                             </div>
//                         </div>
//                     )}
//                 </main>
//             </div>
//         </div>
//     );
// }
// import React, { useState, useEffect, useCallback, useMemo } from 'react';
// import { useAuth, api } from '../hooks/useAuth';
// import Header from './Header';
// import Sidebar from './Sidebar';
// import Alert from  './Alert.jsx'
//
// const TIME_SLOTS = ['07:00','08:00','09:00','10:00','11:00','12:00','13:00','14:00','15:00','16:00','17:00','18:00'];
//
// function formatDateTime(dt) {
//     const y = dt.getFullYear();
//     const m = String(dt.getMonth() + 1).padStart(2, '0');
//     const d = String(dt.getDate()).padStart(2, '0');
//     const hh = String(dt.getHours()).padStart(2, '0');
//     const mm = String(dt.getMinutes()).padStart(2, '0');
//     return `${y}-${m}-${d} ${hh}:${mm}:00`;
// }
//
// function isPastDate(dateStr) {
//     const today = new Date();
//     const d = new Date(`${dateStr}T00:00:00`);
//     return d.setHours(0,0,0,0) < new Date(today.getFullYear(), today.getMonth(), today.getDate()).getTime();
// }
//
// function isWithin48Hours(date) {
//     const now = new Date();
//     const diffH = Math.abs(date - now) / (1000 * 60 * 60);
//     return diffH < 48;
// }
//
// function isValidDate(dateStr, time = '00:00') {
//     const examDate = new Date(`${dateStr}T${time}:00`);
//     return !isPastDate(dateStr) && !isWithin48Hours(examDate);
// }
//
// function calculateExamDurationMinutes(slots) {
//     if (slots.length === 0) return 0;
//     return (slots.length * 45) + Math.max(slots.length - 1, 0) * 15;
// }
//
// export default function TeacherDashboard() {
//     const { user } = useAuth();
//     const [exams, setExams] = useState([]);
//     const [subjects, setSubjects] = useState([]);
//     const [halls, setHalls] = useState([]);
//     const [loading, setLoading] = useState(true);
//     const [fetchError, setFetchError] = useState(null);
//     const [showModal, setShowModal] = useState(false);
//     const [isEditing, setIsEditing] = useState(false);
//     const [currentExamId, setCurrentExamId] = useState(null);
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
//     const [loadingSlots, setLoadingSlots] = useState(false);
//
//     const fetchDashboardData = useCallback(async () => {
//         if (!user || user.role !== 'teacher') return;
//         try {
//             setLoading(true);
//             const res = await api.get('/upcoming_exams');
//             setExams(res.data.exams || []);
//             setSubjects(res.data.subjects || []);
//             setHalls(res.data.halls || []);
//             setFetchError(null);
//         } catch (e) {
//             setFetchError('Грешка при зареждане на данните');
//             console.error(e);
//         } finally {
//             setLoading(false);
//         }
//     }, [user]);
//
//     useEffect(() => {
//         if (user && user.role === 'teacher') fetchDashboardData();
//     }, [user, fetchDashboardData]);
//
//     const fetchBookedSlots = useCallback(async (hallId, date, excludeExamId = null) => {
//         if (!hallId || !date) return;
//         try {
//             setLoadingSlots(true);
//             let url = `/booked-slots?date=${date}&hall_id=${hallId}`;
//             if (excludeExamId) url += `&exclude_exam_id=${excludeExamId}`;
//             const { data } = await api.get(url);
//             setBookedSlots(data.bookedSlots || []);
//         } catch (e) {
//             console.error('Грешка при зареждане на заетите слотове:', e);
//             setBookedSlots([]);
//         } finally {
//             setLoadingSlots(false);
//         }
//     }, []);
//
//     // Функция за проверка дали слот е зает (цялата логика от Blade)
//     const isTimeSlotBooked = useCallback((time) => {
//         const selectedDateTime = new Date(`${selectedDate}T${time}:00`);
//
//         return bookedSlots.some(booking => {
//             if (!booking.start || !booking.end) return false;
//
//             try {
//                 const bookingDate = booking.start.split('T')[0];
//                 if (bookingDate !== selectedDate) return false;
//
//                 const startTime = new Date(booking.start);
//                 const endTime = new Date(booking.end);
//
//                 return selectedDateTime >= startTime && selectedDateTime < endTime;
//             } catch (error) {
//                 console.error('Грешка при обработка на слот:', error);
//                 return false;
//             }
//         });
//     }, [bookedSlots, selectedDate]);
//
//     function handleTimeSlotClick(time) {
//         if (isTimeSlotBooked(time) || !isValidDate(selectedDate, time)) return;
//
//         const all = TIME_SLOTS.slice();
//         const idx = all.indexOf(time);
//         const already = selectedSlots.includes(time);
//
//         if (already) {
//             const i = selectedSlots.indexOf(time);
//             setSelectedSlots(selectedSlots.slice(0, i));
//         } else {
//             if (selectedSlots.length === 0) {
//                 setSelectedSlots([time]);
//             } else {
//                 const last = selectedSlots[selectedSlots.length - 1];
//                 const lastIdx = all.indexOf(last);
//
//                 if (idx === lastIdx + 1) {
//                     setSelectedSlots([...selectedSlots, time]);
//                 } else {
//                     setSelectedSlots([time]);
//                 }
//             }
//         }
//     }
//
//     useEffect(() => {
//         if (selectedSlots.length === 0) {
//             setFormData(fd => ({ ...fd, start_time: '', end_time: '' }));
//             return;
//         }
//         const first = selectedSlots[0];
//         const start = new Date(`${selectedDate}T${first}:00`);
//         const minutes = calculateExamDurationMinutes(selectedSlots);
//         const end = new Date(start.getTime() + minutes * 60000);
//         setFormData(fd => ({
//             ...fd,
//             start_time: formatDateTime(start),
//             end_time: formatDateTime(end)
//         }));
//     }, [selectedSlots, selectedDate]);
//
//     function handleInputChange(e) {
//         const { name, value } = e.target;
//         setFormData(prev => ({ ...prev, [name]: value }));
//         if (name === 'hall_id') {
//             fetchBookedSlots(value, selectedDate, isEditing ? currentExamId : null);
//         }
//     }
//
//     function handleDateChange(e) {
//         const v = e.target.value;
//         setSelectedDate(v);
//         if (formData.hall_id) {
//             fetchBookedSlots(formData.hall_id, v, isEditing ? currentExamId : null);
//         }
//     }
//
//     async function handleSubmit(e) {
//         e.preventDefault();
//         try {
//             const payload = { ...formData };
//             if (!isEditing) {
//                 await api.post('/examStore', payload);
//             } else {
//                 await api.put(`/edit-exams/${currentExamId}`, payload);
//             }
//             setShowModal(false);
//             await fetchDashboardData();
//         } catch (err) {
//             console.error('Save error', err);
//             alert('Възникна грешка при запис.');
//         }
//     }
//
//     function resetForm() {
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
//     }
//
//     function openCreateModal() {
//         resetForm();
//         // Автоматично избиране на първата зала, както е в Blade шаблона
//         if (halls.length > 0) {
//             setFormData(prev => ({ ...prev, hall_id: halls[0].id }));
//             fetchBookedSlots(halls[0].id, new Date().toISOString().split('T')[0]);
//         }
//         setShowModal(true);
//     }
//
//     function openEditModal(exam) {
//         setIsEditing(true);
//         setCurrentExamId(exam.id);
//         setFormData({
//             subject_id: String(exam.subject_id ?? ''),
//             exam_type: exam.exam_type ?? 'редовен',
//             max_students: String(exam.max_students ?? ''),
//             hall_id: String(exam.hall_id ?? ''),
//             start_time: exam.start_time ?? '',
//             end_time: exam.end_time ?? ''
//         });
//
//         const start = new Date(exam.start_time);
//         const end = new Date(exam.end_time);
//         const dateStr = `${start.getFullYear()}-${String(start.getMonth()+1).padStart(2,'0')}-${String(start.getDate()).padStart(2,'0')}`;
//         setSelectedDate(dateStr);
//
//         const startHH = String(start.getHours()).padStart(2, '0') + ':00';
//         const endHH = String(end.getHours()).padStart(2, '0') + ':00';
//         const startIdx = TIME_SLOTS.indexOf(startHH);
//         const endIdx = TIME_SLOTS.indexOf(endHH);
//         const sel = (startIdx >= 0 && endIdx >= startIdx) ? TIME_SLOTS.slice(startIdx, endIdx + 1) : [startHH];
//         setSelectedSlots(sel);
//
//         setShowModal(true);
//         fetchBookedSlots(exam.hall_id, dateStr, exam.id);
//     }
//
//     if (!user || user.role !== 'teacher') {
//         return (
//             <div className="min-h-screen bg-gradient-to-br from-indigo-50 to-blue-50">
//                 <Header />
//                 <div className="container mx-auto p-6">
//                     <div className="bg-red-50 text-red-700 border border-red-200 rounded-xl p-4">
//                         Нямате необходимите права за достъп до тази страница.
//                     </div>
//                 </div>
//             </div>
//         );
//     }
//
//     if (loading) {
//         return (
//             <div className="min-h-screen bg-gradient-to-br from-indigo-50 to-blue-50">
//                 <Header />
//                 <div className="flex items-center justify-center min-h-[calc(100vh-64px)]">
//                     <div className="animate-pulse text-indigo-600">Зареждане…</div>
//                 </div>
//             </div>
//         );
//     }
//
//     return (
//         <div className="min-h-screen bg-gradient-to-br from-indigo-50 to-blue-50 font-[Inter] overflow-x-hidden">
//             <Header />
//             <div className="page-layout">
//                 <Sidebar user={user} />
//
//                 <main className="p-4 lg:p-6 relative z-0">
//                     <div className="bg-white/90 backdrop-blur-md shadow-sm py-6 mb-8 rounded-xl border border-gray-100">
//                         <div className="flex flex-col md:flex-row justify-between items-start md:items-center px-6 gap-4">
//                             <div>
//                                 <h1 className="text-2xl font-bold text-gray-800">Управление на изпити</h1>
//                                 <p className="text-sm text-gray-500 mt-1">Преглед на предстоящи изпити и възможност за добавяне</p>
//                             </div>
//                             <a href="/conducted-exams"
//                                className="inline-flex items-center gap-1 px-4 py-2.5 bg-green-500 text-white rounded-lg shadow hover:bg-green-600 transition-colors">
//                                 <i className="fa-duotone fa-solid fa-folder-open"></i>
//                                 Изминали изпити
//                             </a>
//                         </div>
//                     </div>
//
//                     {!exams || exams.length === 0 ? (
//                         <div className="text-center p-8 bg-white border border-gray-100 shadow-sm rounded-xl">
//                             <i className="fas fa-calendar-plus text-4xl text-gray-300 mb-4"></i>
//                             <h3 className="text-lg font-medium text-gray-700 mb-2">Няма създадени изпити</h3>
//                             <button onClick={openCreateModal}
//                                     className="mt-4 bg-blue-600 text-white px-6 py-2.5 rounded-lg hover:bg-blue-700 transition-colors">
//                                 Нов изпит
//                             </button>
//                         </div>
//                     ) : (
//                         <>
//                             <div className="grid gap-6 grid-cols-1 sm:grid-cols-2 xl:grid-cols-3">
//                                 {exams.map((exam) => {
//                                     const startsInLessThan48h = isWithin48Hours(new Date(exam.start_time));
//
//                                     return (
//                                         <div key={exam.id}
//                                              className="flex flex-col bg-white border border-gray-100 rounded-xl p-6 hover:shadow-md transition-all hover:border-primary-100 hover:-translate-y-0.5">
//                                             <div className="flex justify-between items-start gap-2 mb-3">
//                                                 <h2 className="text-lg font-semibold text-gray-900">
//                                                     {exam.subject?.subject_name}
//                                                     <span className="block text-sm font-normal text-gray-500 mt-1">
//                                                         {exam.subject?.description}
//                                                     </span>
//                                                 </h2>
//                                                 <span className="px-2.5 py-1 rounded-full text-xs font-medium bg-purple-100 text-purple-800">
//                                                     {exam.exam_type}
//                                                 </span>
//                                             </div>
//
//                                             <div className="space-y-3 mb-5">
//                                                 <div className="flex items-center gap-2 text-gray-600">
//                                                     <i className="fas fa-calendar-alt w-5 text-gray-400"></i>
//                                                     <span>Дата: <span className="font-medium text-gray-800">
//                                                         {new Date(exam.start_time).toLocaleDateString('bg-BG')}
//                                                     </span></span>
//                                                 </div>
//                                                 <div className="flex items-center gap-2 text-gray-600">
//                                                     <i className="fas fa-clock w-5 text-gray-400"></i>
//                                                     <span>Час: <span className="font-medium text-gray-800">
//                                                         {new Date(exam.start_time).toLocaleTimeString('bg-BG', { hour: '2-digit', minute: '2-digit' })} -
//                                                         {new Date(exam.end_time).toLocaleTimeString('bg-BG', { hour: '2-digit', minute: '2-digit' })}
//                                                     </span></span>
//                                                 </div>
//                                                 <div className="flex items-center gap-2 text-gray-600">
//                                                     <i className="fas fa-university w-5 text-gray-400"></i>
//                                                     <span>Зала: <span className="font-medium text-gray-800">{exam.hall?.name}</span></span>
//                                                 </div>
//                                                 <div className="flex items-center gap-2 text-gray-600">
//                                                     <i className="fas fa-users w-5 text-gray-400"></i>
//                                                     <span className={`font-medium ${exam.remainingSlots > 0 ? 'text-green-700' : 'text-red-700'}`}>
//                                                         {exam.remainingSlots}/{exam.max_students} места
//                                                     </span>
//                                                 </div>
//                                             </div>
//
//                                             <button
//                                                 onClick={() => openEditModal(exam)}
//                                                 disabled={startsInLessThan48h}
//                                                 className={`mt-auto w-full px-4 py-2.5 rounded-xl text-white font-medium transition-colors duration-200
//                                                     ${startsInLessThan48h
//                                                     ? 'bg-gray-300 cursor-not-allowed'
//                                                     : 'bg-blue-600 hover:bg-blue-700'}`}
//                                                 title={startsInLessThan48h ? 'Редакция не е позволена по-малко от 48 часа преди началото' : ''}
//                                             >
//                                                 <i className="fa-solid fa-file-pen mr-2"></i> Редактирай изпит
//                                             </button>
//                                         </div>
//                                     );
//                                 })}
//                             </div>
//
//                             <div className="flex items-center justify-center mt-6">
//                                 <button onClick={openCreateModal}
//                                         className="w-16 h-16 rounded-full bg-indigo-600 hover:bg-indigo-700 text-white shadow-xl flex items-center justify-center transition-all duration-300 hover:rotate-90">
//                                     <svg className="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24">
//                                         <path strokeLinecap="round" strokeLinejoin="round" strokeWidth="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/>
//                                     </svg>
//                                 </button>
//                             </div>
//                         </>
//                     )}
//
//                     {showModal && (
//                         <div className="fixed inset-0 z-50 bg-black/50 backdrop-blur-sm flex items-center justify-center p-4"
//                              onClick={() => setShowModal(false)}>
//                             <div className="bg-white rounded-xl shadow-2xl w-full max-w-md p-6 mx-4 relative"
//                                  onClick={e => e.stopPropagation()}>
//
//                                 <h3 className="text-xl font-bold text-gray-900 mb-4">
//                                     {isEditing ? 'Редактиране на изпит' : 'Създаване на нов изпит'}
//                                 </h3>
//
//                                 <form onSubmit={handleSubmit} className="space-y-4">
//                                     <div>
//                                         <label className="block text-sm font-medium text-gray-700 mb-2">Дисциплина</label>
//                                         <select
//                                             name="subject_id"
//                                             value={formData.subject_id}
//                                             onChange={handleInputChange}
//                                             required
//                                             disabled={isEditing}
//                                             className="w-full px-4 py-2 rounded-lg border border-gray-200 focus:ring-2 focus:ring-blue-500 transition-all"
//                                         >
//                                             <option value="">Изберете дисциплина</option>
//                                             {subjects.map(s => (
//                                                 <option key={s.id} value={s.id}>
//                                                     {s.subject_name} {s.semester && `(Сем. ${s.semester})`}
//                                                 </option>
//                                             ))}
//                                         </select>
//                                     </div>
//
//                                     <div className="grid grid-cols-2 gap-4">
//                                         <div>
//                                             <label className="block text-sm font-medium text-gray-700 mb-2">Тип изпит</label>
//                                             <select
//                                                 name="exam_type"
//                                                 value={formData.exam_type}
//                                                 onChange={handleInputChange}
//                                                 required
//                                                 disabled={isEditing}
//                                                 className="w-full px-4 py-2 rounded-lg border border-gray-200 focus:ring-2 focus:ring-blue-500 transition-all"
//                                             >
//                                                 <option value="редовен">Редовен</option>
//                                                 <option value="поправителен">Поправителен</option>
//                                                 <option value="ликвидация">Ликвидация</option>
//                                             </select>
//                                         </div>
//                                         <div>
//                                             <label className="block text-sm font-medium text-gray-700 mb-2">Макс. студенти</label>
//                                             <input
//                                                 type="number"
//                                                 name="max_students"
//                                                 min="1"
//                                                 value={formData.max_students}
//                                                 onChange={handleInputChange}
//                                                 required
//                                                 className="w-full px-4 py-2 rounded-lg border border-gray-200 focus:ring-2 focus:ring-blue-500 transition-all"
//                                             />
//                                         </div>
//                                     </div>
//
//                                     <div>
//                                         <label className="block text-sm font-medium text-gray-700 mb-2">Изпитна зала</label>
//                                         <select
//                                             name="hall_id"
//                                             value={formData.hall_id}
//                                             onChange={handleInputChange}
//                                             required
//                                             className="w-full px-4 py-2 rounded-lg border border-gray-200 focus:ring-2 focus:ring-blue-500 transition-all"
//                                         >
//                                             <option value="">Изберете зала</option>
//                                             {halls.map(h => (
//                                                 <option key={h.id} value={h.id}>
//                                                     {h.name} ({h.capacity} места)
//                                                 </option>
//                                             ))}
//                                         </select>
//                                     </div>
//
//                                     <div>
//                                         <label className="block text-sm font-medium text-gray-700 mb-2">Дата</label>
//                                         <input
//                                             type="date"
//                                             value={selectedDate}
//                                             onChange={handleDateChange}
//                                             required
//                                             className="w-full px-4 py-2 rounded-lg border border-gray-200 focus:ring-2 focus:ring-blue-500 transition-all"
//                                         />
//                                     </div>
//
//                                     <div>
//                                         <label className="block text-sm font-medium text-gray-700 mb-2">Изберете свободни часове</label>
//                                         <div className="mt-2">
//                                             <h4 className="text-center font-medium mb-2">
//                                                 Стая <span>
//                                                     {formData.hall_id ? halls.find(h => h.id == formData.hall_id)?.name : '---'}
//                                                 </span>
//                                             </h4>
//
//                                             {loadingSlots ? (
//                                                 <div className="text-center py-4">
//                                                     <i className="fas fa-spinner fa-spin text-blue-500 mr-2"></i>
//                                                     <span className="text-gray-600">Зареждане на слотове...</span>
//                                                 </div>
//                                             ) : (
//                                                 <div className="grid grid-cols-3 gap-2">
//                                                     {TIME_SLOTS.map(time => {
//                                                         const isBooked = isTimeSlotBooked(time);
//                                                         const isSelected = selectedSlots.includes(time);
//                                                         const isValid = isValidDate(selectedDate, time);
//
//                                                         return (
//                                                             <button
//                                                                 key={time}
//                                                                 type="button"
//                                                                 className={`py-3 rounded-lg text-white font-medium transition-colors
//                                                                     ${isSelected ? 'bg-blue-500 hover:bg-blue-600' :
//                                                                     isBooked ? 'bg-red-500 cursor-not-allowed' :
//                                                                         isValid ? 'bg-green-500 hover:bg-green-600' :
//                                                                             'bg-gray-300 cursor-not-allowed'}`}
//                                                                 disabled={isBooked || !isValid}
//                                                                 onClick={() => handleTimeSlotClick(time)}
//                                                                 title={!isValid ? "Моля, изберете валидни дата и час за изпита." : ""}
//                                                             >
//                                                                 {time}
//                                                             </button>
//                                                         );
//                                                     })}
//                                                 </div>
//                                             )}
//                                         </div>
//                                     </div>
//
//                                     <div className="flex justify-end gap-3 mt-6">
//                                         <button type="button"
//                                                 onClick={() => setShowModal(false)}
//                                                 className="px-5 py-2.5 text-gray-600 hover:bg-gray-50 rounded-lg transition-colors">
//                                             Отказ
//                                         </button>
//                                         <button type="submit"
//                                                 disabled={selectedSlots.length === 0}
//                                                 className={`px-5 py-2.5 bg-blue-600 hover:bg-blue-700 text-white rounded-lg transition-colors
//                                                     ${selectedSlots.length === 0 ? 'opacity-50 cursor-not-allowed' : ''}`}>
//                                             {isEditing ? 'Редактирай' : 'Създай'}
//                                         </button>
//                                     </div>
//                                 </form>
//                             </div>
//                         </div>
//                     )}
//                 </main>
//             </div>
//         </div>
//     );
// }
import React, { useState, useEffect, useCallback, useMemo } from 'react';
import { useAuth, api } from '../hooks/useAuth';
import {Link}  from "react-router-dom";
import Header from './Header';
import Sidebar from './Sidebar';
import Alert from './Alert'; // Import the Alert component

const TIME_SLOTS = ['07:00','08:00','09:00','10:00','11:00','12:00','13:00','14:00','15:00','16:00','17:00','18:00'];

function formatDateTime(dt) {
    const y = dt.getFullYear();
    const m = String(dt.getMonth() + 1).padStart(2, '0');
    const d = String(dt.getDate()).padStart(2, '0');
    const hh = String(dt.getHours()).padStart(2, '0');
    const mm = String(dt.getMinutes()).padStart(2, '0');
    return `${y}-${m}-${d} ${hh}:${mm}:00`;
}

function isPastDate(dateStr) {
    const today = new Date();
    const d = new Date(`${dateStr}T00:00:00`);
    return d.setHours(0,0,0,0) < new Date(today.getFullYear(), today.getMonth(), today.getDate()).getTime();
}

function isWithin48Hours(date) {
    const now = new Date();
    const diffH = Math.abs(date - now) / (1000 * 60 * 60);
    return diffH < 48;
}

function isValidDate(dateStr, time = '00:00') {
    const examDate = new Date(`${dateStr}T${time}:00`);
    return !isPastDate(dateStr) && !isWithin48Hours(examDate);
}

function calculateExamDurationMinutes(slots) {
    if (slots.length === 0) return 0;
    return (slots.length * 45) + Math.max(slots.length - 1, 0) * 15;
}

export default function TeacherDashboard() {
    const { user } = useAuth();
    const [exams, setExams] = useState([]);
    const [subjects, setSubjects] = useState([]);
    const [halls, setHalls] = useState([]);
    const [loading, setLoading] = useState(true);
    const [alert, setAlert] = useState({ type: '', message: '', visible: false }); // Alert state
    const [showModal, setShowModal] = useState(false);
    const [isEditing, setIsEditing] = useState(false);
    const [currentExamId, setCurrentExamId] = useState(null);
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
    const [loadingSlots, setLoadingSlots] = useState(false);

    // Show alert function
    const showAlert = (type, message) => {
        setAlert({ type, message, visible: true });
        setTimeout(() => {
            setAlert({ type: '', message: '', visible: false });
        }, 5000);
    };

    const fetchDashboardData = useCallback(async () => {
        if (!user || user.role !== 'teacher') return;
        try {
            setLoading(true);
            const res = await api.get('/upcoming_exams');
            setExams(res.data.exams || []);
            setSubjects(res.data.subjects || []);
            setHalls(res.data.halls || []);
            console.log(res)

        } catch (e) {
            showAlert('error', 'Грешка при зареждане на данните');
            console.error(e);
        } finally {
            setLoading(false);
        }
    }, [user]);

    useEffect(() => {
        if (user && user.role === 'teacher') fetchDashboardData();
    }, [user, fetchDashboardData]);

    const fetchBookedSlots = useCallback(async (hallId, date, excludeExamId = null) => {
        if (!hallId || !date) return;
        try {
            setLoadingSlots(true);
            let url = `/booked-slots?date=${date}&hall_id=${hallId}`;
            if (excludeExamId) url += `&exclude_exam_id=${excludeExamId}`;
            const { data } = await api.get(url);
            setBookedSlots(data.bookedSlots || []);
        } catch (e) {
            console.error('Грешка при зареждане на заетите слотове:', e);
            setBookedSlots([]);
        } finally {
            setLoadingSlots(false);
        }
    }, []);

    const isTimeSlotBooked = useCallback((time) => {
        const selectedDateTime = new Date(`${selectedDate}T${time}:00`);

        return bookedSlots.some(booking => {
            if (!booking.start || !booking.end) return false;

            try {
                const bookingDate = booking.start.split('T')[0];
                if (bookingDate !== selectedDate) return false;

                const startTime = new Date(booking.start);
                const endTime = new Date(booking.end);

                return selectedDateTime >= startTime && selectedDateTime < endTime;
            } catch (error) {
                console.error('Грешка при обработка на слот:', error);
                return false;
            }
        });
    }, [bookedSlots, selectedDate]);

    function handleTimeSlotClick(time) {
        if (isTimeSlotBooked(time) || !isValidDate(selectedDate, time)) return;

        const all = TIME_SLOTS.slice();
        const idx = all.indexOf(time);
        const already = selectedSlots.includes(time);

        if (already) {
            const i = selectedSlots.indexOf(time);
            setSelectedSlots(selectedSlots.slice(0, i));
        } else {
            if (selectedSlots.length === 0) {
                setSelectedSlots([time]);
            } else {
                const last = selectedSlots[selectedSlots.length - 1];
                const lastIdx = all.indexOf(last);

                if (idx === lastIdx + 1) {
                    setSelectedSlots([...selectedSlots, time]);
                } else {
                    setSelectedSlots([time]);
                }
            }
        }
    }

    useEffect(() => {
        if (selectedSlots.length === 0) {
            setFormData(fd => ({ ...fd, start_time: '', end_time: '' }));
            return;
        }
        const first = selectedSlots[0];
        const start = new Date(`${selectedDate}T${first}:00`);
        const minutes = calculateExamDurationMinutes(selectedSlots);
        const end = new Date(start.getTime() + minutes * 60000);
        setFormData(fd => ({
            ...fd,
            start_time: formatDateTime(start),
            end_time: formatDateTime(end)
        }));
    }, [selectedSlots, selectedDate]);

    function handleInputChange(e) {
        const { name, value } = e.target;
        setFormData(prev => ({ ...prev, [name]: value }));
        if (name === 'hall_id') {
            fetchBookedSlots(value, selectedDate, isEditing ? currentExamId : null);
        }
    }


    function handleDateChange(e) {
        const v = e.target.value;
        setSelectedDate(v);
        if (formData.hall_id) {
            fetchBookedSlots(formData.hall_id, v, isEditing ? currentExamId : null);
        }
    }

    async function handleSubmit(e) {
        e.preventDefault();
        try {
            // const selectedHall = halls.find(hall => hall.id == formData.hall_id);
            // if (Number(formData.max_students) > selectedHall.capacity) {
            //     showAlert("error", `Надвишава капацитета на залата (${selectedHall.capacity} места)`);
            //     return;
            // }
            const payload = { ...formData };
            if (!isEditing) {
                await api.post('/examStore', payload);
                showAlert('success', 'Изпитът е създаден успешно!');
            } else {
                await api.put(`/edit-exams/${currentExamId}`, payload);
                showAlert('success', 'Изпитът е редактиран успешно!');
            }
            setShowModal(false);
            await fetchDashboardData();
        } catch (err) {
            console.error('Save error', err);
            // showAlert('error', 'Възникна грешка при запис.');
            const errorMessage = err.response?.data?.message || 'Възникна грешка при запис.';
            showAlert('error', errorMessage);
        }
    }
    const selectedHall = halls.find(h => h.id == formData.hall_id);
    const isOverCapacity = selectedHall && formData.max_students > selectedHall.capacity;
    function resetForm() {
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
    }

    function openCreateModal() {
        resetForm();
        if (halls.length > 0) {
            setFormData(prev => ({ ...prev, hall_id: halls[0].id }));
            fetchBookedSlots(halls[0].id, new Date().toISOString().split('T')[0]);
        }
        setShowModal(true);
    }

    function openEditModal(exam) {
        setIsEditing(true);
        setCurrentExamId(exam.id);
        setFormData({
            subject_id: String(exam.subject_id ?? ''),
            exam_type: exam.exam_type ?? 'редовен',
            max_students: String(exam.max_students ?? ''),
            hall_id: String(exam.hall_id ?? ''),
            start_time: exam.start_time ?? '',
            end_time: exam.end_time ?? ''
        });

        const start = new Date(exam.start_time);
        const end = new Date(exam.end_time);
        const dateStr = `${start.getFullYear()}-${String(start.getMonth()+1).padStart(2,'0')}-${String(start.getDate()).padStart(2,'0')}`;
        setSelectedDate(dateStr);

        const startHH = String(start.getHours()).padStart(2, '0') + ':00';
        const endHH = String(end.getHours()).padStart(2, '0') + ':00';
        const startIdx = TIME_SLOTS.indexOf(startHH);
        const endIdx = TIME_SLOTS.indexOf(endHH);
        const sel = (startIdx >= 0 && endIdx >= startIdx) ? TIME_SLOTS.slice(startIdx, endIdx + 1) : [startHH];
        setSelectedSlots(sel);

        setShowModal(true);
        fetchBookedSlots(exam.hall_id, dateStr, exam.id);
    }

    if (!user || user.role !== 'teacher') {
        return (
            <div className="min-h-screen bg-gradient-to-br from-indigo-50 to-blue-50">
                <Header />
                <div className="container mx-auto p-6">
                    <div className="bg-red-50 text-red-700 border border-red-200 rounded-xl p-4">
                        Нямате необходимите права за достъп до тази страница.
                    </div>
                </div>
            </div>
        );
    }

    if (loading) {
        return (
            <div className="min-h-screen bg-gradient-to-br from-indigo-50 to-blue-50">
                <Header />
                <div className="flex items-center justify-center min-h-[calc(100vh-64px)]">
                    <div className="animate-pulse text-indigo-600">Зареждане…</div>
                </div>
            </div>
        );
    }

    return (
        <div className="min-h-screen bg-gradient-to-br from-indigo-50 to-blue-50 font-[Inter] overflow-x-hidden">
            <Header />
            <div className="page-layout">
                <Sidebar user={user} />

                <main className="p-4 lg:p-6 relative z-0">
                    {/* Alert component */}
                    {alert.visible && (
                        <Alert type={alert.type} message={alert.message} onClose={() => setAlert({ type: '', message: '', visible: false })} />
                    )}

                    <div className="bg-white/90 backdrop-blur-md shadow-sm py-6 mb-8 rounded-xl border border-gray-100">
                        <div className="flex flex-col md:flex-row justify-between items-start md:items-center px-6 gap-4">
                            <div>
                                <h1 className="text-2xl font-bold text-gray-800">Управление на изпити</h1>
                                <p className="text-sm text-gray-500 mt-1">Преглед на предстоящи изпити и възможност за добавяне</p>
                            </div>
                            <a href="/conducted-exams"
                               className="inline-flex items-center gap-1 px-4 py-2.5 bg-green-500 text-white rounded-lg shadow hover:bg-green-600 transition-colors">
                                <i className="fa-duotone fa-solid fa-folder-open"></i>
                                Изминали изпити
                            </a>
                        </div>
                    </div>

                    {!exams || exams.length === 0 ? (
                        <div className="text-center p-8 bg-white border border-gray-100 shadow-sm rounded-xl">
                            <i className="fas fa-calendar-plus text-4xl text-gray-300 mb-4"></i>
                            <h3 className="text-lg font-medium text-gray-700 mb-2">Няма създадени изпити</h3>
                            <button onClick={openCreateModal}
                                    className="mt-4 bg-blue-600 text-white px-6 py-2.5 rounded-lg hover:bg-blue-700 transition-colors">
                                Нов изпит
                            </button>
                        </div>
                    ) : (
                        <div>
                            <div className="grid gap-6 grid-cols-1 sm:grid-cols-2 xl:grid-cols-3">
                                {exams.map((exam) => {
                                    const startsInLessThan48h = isWithin48Hours(new Date(exam.start_time));

                                    return (
                                        <div key={exam.id}
                                             className="flex flex-col bg-white border border-gray-100 rounded-xl p-6 hover:shadow-md transition-all hover:border-primary-100 hover:-translate-y-0.5">
                                            <div className="flex justify-between items-start gap-2 mb-3">
                                                <h2 className="text-lg font-semibold text-gray-900">
                                                    {exam.subject?.subject_name}
                                                    <span className="block text-sm font-normal text-gray-500 mt-1">
                                                        {exam.subject?.description}
                                                    </span>
                                                </h2>
                                                <div className="flex item-center gap-2">
                                                     <span className="px-2.5 py-1 rounded-full text-xs font-medium bg-purple-100 text-purple-800">
                                                        {exam.exam_type}
                                                     </span>
                                                    <Link
                                                        to={`/exam/${exam.id}/students`}
                                                        // className="text-purple-600 hover:text-purple-700"
                                                        className="bg-purple-100 text-purple-800 hover:bg-purple-200 px-2 py-1 rounded-full text-xs"
                                                        title="Виж студенти"
                                                    >
                                                        <i className="fas fa-users text-sm"></i>
                                                    </Link>
                                                </div>
                                            </div>


                                            <div className="space-y-3 mb-5">
                                                <div className="flex items-center gap-2 text-gray-600">
                                                    <i className="fas fa-calendar-alt w-5 text-gray-400"></i>
                                                    <span>Дата: <span className="font-medium text-gray-800">
                                                        {new Date(exam.start_time).toLocaleDateString('bg-BG')}
                                                    </span></span>
                                                </div>
                                                <div className="flex items-center gap-2 text-gray-600">
                                                    <i className="fas fa-clock w-5 text-gray-400"></i>
                                                    <span>Час: <span className="font-medium text-gray-800">
                                                        {new Date(exam.start_time).toLocaleTimeString('bg-BG', { hour: '2-digit', minute: '2-digit' })} -
                                                        {new Date(exam.end_time).toLocaleTimeString('bg-BG', { hour: '2-digit', minute: '2-digit' })}
                                                    </span></span>
                                                </div>
                                                <div className="flex items-center gap-2 text-gray-600">
                                                    <i className="fas fa-university w-5 text-gray-400"></i>
                                                    <span>Зала: <span className="font-medium text-gray-800">{exam.hall?.name}</span></span>
                                                </div>
                                                <div className="flex items-center gap-2 text-gray-600">
                                                    <i className="fas fa-users w-5 text-gray-400"></i>
                                                    <span className={`font-medium ${exam.remaining_slots > 0 ? 'text-green-700' : 'text-red-700'}`}>
                                                        {exam.remaining_slots}/{exam.max_students} места
                                                    </span>
                                                </div>
                                            </div>

                                            <button
                                                onClick={() => openEditModal(exam)}
                                                disabled={startsInLessThan48h}
                                                className={`mt-auto w-full px-4 py-2.5 rounded-xl text-white font-medium transition-colors duration-200
                                                    ${startsInLessThan48h
                                                    ? 'bg-gray-300 cursor-not-allowed'
                                                    : 'bg-blue-600 hover:bg-blue-700'}`}
                                                title={startsInLessThan48h ? 'Редакция не е позволена по-малко от 48 часа преди началото' : ''}
                                            >
                                                <i className="fa-solid fa-file-pen mr-2"></i> Редактирай изпит
                                            </button>
                                        </div>
                                    );
                                })}
                            {/*</div>*/}

                            <div className="flex items-center justify-center mt-6">
                                <button onClick={openCreateModal}
                                        className="w-16 h-16 rounded-full bg-indigo-600 hover:bg-indigo-700 text-white shadow-xl flex items-center justify-center transition-all duration-300 hover:rotate-90">
                                    <svg className="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path strokeLinecap="round" strokeLinejoin="round" strokeWidth="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/>
                                    </svg>
                                </button>
                            </div>
                        </div>
                        </div>
                    )};

                    {showModal && (
                        <div className="fixed inset-0 z-50 bg-black/50 backdrop-blur-sm flex items-center justify-center p-4"
                             onClick={() => setShowModal(false)}>
                            <div className="bg-white rounded-xl shadow-2xl w-full max-w-md p-6 mx-4 relative"
                                 onClick={e => e.stopPropagation()}>

                                <h3 className="text-xl font-bold text-gray-900 mb-4">
                                    {isEditing ? 'Редактиране на изпит' : 'Създаване на нов изпит'}
                                </h3>

                                <form onSubmit={handleSubmit} className="space-y-4">
                                    <div>
                                        <label className="block text-sm font-medium text-gray-700 mb-2">Дисциплина</label>
                                        <select
                                            name="subject_id"
                                            value={formData.subject_id}
                                            onChange={handleInputChange}
                                            required
                                            disabled={isEditing}
                                            className="w-full px-4 py-2 rounded-lg border border-gray-200 focus:ring-2 focus:ring-blue-500 transition-all"
                                        >
                                            <option value="">Изберете дисциплина</option>
                                            {subjects.map(s => (
                                                <option key={s.id} value={s.id}>
                                                    {s.subject_name} {s.semester && `(Сем. ${s.semester})`}
                                                </option>
                                            ))}
                                        </select>
                                    </div>

                                    <div className="grid grid-cols-2 gap-4">
                                        <div>
                                            <label className="block text-sm font-medium text-gray-700 mb-2">Тип изпит</label>
                                            <select
                                                name="exam_type"
                                                value={formData.exam_type}
                                                onChange={handleInputChange}
                                                required
                                                disabled={isEditing}
                                                className="w-full px-4 py-2 rounded-lg border border-gray-200 focus:ring-2 focus:ring-blue-500 transition-all"
                                            >
                                                <option value="редовен">Редовен</option>
                                                <option value="поправителен">Поправителен</option>
                                                <option value="ликвидация">Ликвидация</option>
                                            </select>
                                        </div>
                                        <div>
                                            <label className="block text-sm font-medium text-gray-700 mb-2">Макс. студенти</label>
                                            <input
                                                type="number"
                                                name="max_students"
                                                min="1"
                                                value={formData.max_students}
                                                onChange={handleInputChange}
                                                required
                                                className={`w-full px-4 py-2 rounded-lg border focus:ring-2 focus:ring-blue-500 transition-all ${
                                                    isOverCapacity
                                                        ? 'border-red-500 bg-red-50'
                                                        : 'border-gray-200'
                                                }`}
                                            />
                                            {isOverCapacity&&(
                                                <p className="text-red-500 text-sm mt-1">
                                                    Надвишава капацитета на залата ({selectedHall.capacity} места)
                                                </p>
                                            )}
                                        </div>
                                    </div>

                                    <div>
                                        <label className="block text-sm font-medium text-gray-700 mb-2">Изпитна зала</label>
                                        <select
                                            name="hall_id"
                                            value={formData.hall_id}
                                            onChange={handleInputChange}
                                            required
                                            className="w-full px-4 py-2 rounded-lg border border-gray-200 focus:ring-2 focus:ring-blue-500 transition-all"
                                        >
                                            <option value="">Изберете зала</option>
                                            {halls.map(hall => (
                                                <option key={hall.id} value={hall.id}>
                                                    {hall.name} ({hall.capacity} места)
                                                </option>
                                            ))}
                                        </select>
                                    </div>

                                    <div>
                                        <label className="block text-sm font-medium text-gray-700 mb-2">Дата</label>
                                        <input
                                            type="date"
                                            value={selectedDate}
                                            onChange={handleDateChange}
                                            required
                                            className="w-full px-4 py-2 rounded-lg border border-gray-200 focus:ring-2 focus:ring-blue-500 transition-all"
                                        />
                                    </div>

                                    <div>
                                        <label className="block text-sm font-medium text-gray-700 mb-2">Изберете свободни часове</label>
                                        <div className="mt-2">
                                            <h4 className="text-center font-medium mb-2">
                                                Стая <span>
                                                    {formData.hall_id ? halls.find(h => h.id == formData.hall_id)?.name : '---'}
                                                </span>
                                            </h4>

                                            {loadingSlots ? (
                                                <div className="text-center py-4">
                                                    <i className="fas fa-spinner fa-spin text-blue-500 mr-2"></i>
                                                    <span className="text-gray-600">Зареждане на слотове...</span>
                                                </div>
                                            ) : (
                                                <div className="grid grid-cols-3 gap-2">
                                                    {TIME_SLOTS.map(time => {
                                                        const isBooked = isTimeSlotBooked(time);
                                                        const isSelected = selectedSlots.includes(time);
                                                        const isValid = isValidDate(selectedDate, time);

                                                        return (
                                                            <button
                                                                key={time}
                                                                type="button"
                                                                className={`py-3 rounded-lg text-white font-medium transition-colors
                                                                    ${isSelected ? 'bg-blue-500 hover:bg-blue-600' :
                                                                    isBooked ? 'bg-red-500 cursor-not-allowed' :
                                                                        isValid ? 'bg-green-500 hover:bg-green-600' :
                                                                            'bg-gray-300 cursor-not-allowed'}`}
                                                                disabled={isBooked || !isValid}
                                                                onClick={() => handleTimeSlotClick(time)}
                                                                title={!isValid ? "Моля, изберете валидни дата и час за изпита." : ""}
                                                            >
                                                                {time}
                                                            </button>
                                                        );
                                                    })}
                                                </div>
                                            )}
                                        </div>
                                    </div>

                                    <div className="flex justify-end gap-3 mt-6">
                                        <button type="button"
                                                onClick={() => setShowModal(false)}
                                                className="px-5 py-2.5 text-gray-600 hover:bg-gray-50 rounded-lg transition-colors">
                                            Отказ
                                        </button>
                                        <button type="submit"
                                                disabled={selectedSlots.length === 0||isOverCapacity}
                                                className={`px-5 py-2.5 bg-blue-600 hover:bg-blue-700 text-white rounded-lg transition-colors
                                                    ${selectedSlots.length === 0 ||isOverCapacity ? 'opacity-50 cursor-not-allowed' : ''}`}>
                                            {isEditing ? 'Редактирай' : 'Създай'}
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    )}
                </main>
            </div>
        </div>
    );
}
